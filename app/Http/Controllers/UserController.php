<?php
namespace App\Http\Controllers;

use App\Core\Repositories\UserRepository;

use App\User;

use App\Core\Infra\Infra_Filtro;

use Illuminate\Http\Request;
use Input;


/**************************************************************************************************
*
* Cadastro de Usuários
*
* objetivo: Cadastrar os Usuários
*
***************************************************************************************************/

class UserController extends MeuController {

   protected $UserRepository;

   /**
   * Create a new  instance.
   * @return void
   */
   public function __construct( UserRepository $user_repository ) {
      $this->UserRepository = $user_repository;
   } // __construct

   /**
   * Exibe o grid
   */
   public function exibir_grid() {
      $this->UserRepository->obter_filtro( $resultado );
      $data = User::whereRaw( $resultado->where )->orderBy( $resultado->ordem )
                                                 ->paginate( $this->registros_por_pagina );   
      return view( 'user.user_grid' )->with( 'data', $data )
                                     ->with( 'filtros', $resultado->inputs );
   } // exibir_grid

   /**
   * Exibe o form
   */
   public function exibir_form( $acao, $id = null ) {
      Infra_Filtro::manter_filtros( 'S' );
      $this->UserRepository->acao = $acao;
      $this->UserRepository->igualar_formulario( $data, $id );
      return view( 'user.user_form' )->with( 'data',     $data  )
                                     ->with( 'acao',     $acao  );
   } // exibir_form   

   /**
   * Confirma a Inclusao, alteração e exclusão
   */
   public function Confirmar() {      
      switch ( Input::get('acao') ) {
         case 'incluir':
            $this->UserRepository->Incluir( Input::all() );
            break;
         
         case 'alterar':         
            $this->UserRepository->Alterar( Input::all() );
            break;
         
         case 'excluir':
            $this->UserRepository->Excluir( Input::get('id') );
            break;
               
         default:
            break;
      }

      if ( !$this->UserRepository->tudo_ok ) {
          $data = (object)Input::all();          
          return view( 'user.user_form' )->with( 'data',  $data )
                                     ->withErrors( $this->UserRepository->validacao   );
      }
      return redirect( 'user' );
   } // Confirmar


   /**
   * Iguala o Objeto
   */
   public function igualar_objeto( &$user ) {
      $user->name  = Input::get('name');
      $user->email = Input::get('email');
      $user->password = bcrypt( Input::get('password') );
   } // igualar_objeto

   /**
   * Define as regras de validação
   *
   * @return void
   */
   public function definir_regras() {           
      $this->regras = [ 'name'               => 'required|min:2|max:60',  
                        'email'              => 'required|unique:users,email,'.Input::get('id'),
                        'password'           => 'required|confirmed|min:6',
                        'password_confirmation' => 'required'

                      ];
   } // definir_regras

   public function cancelar() {
      return redirect( 'user' );
   } // cancelar

   /**
   * obtém os filtros
   */
   public function obter_filtro( &$resultado ) {
      $filtro = array();      
      $resultado = new \stdClass();

      $infra_filtro = new Infra_Filtro();
      // define os nomes dos filtros
      $infra_filtro->nomes_filtros  = new \stdClass();
      $infra_filtro->nomes_filtros->filtro_name  = '';
      $infra_filtro->nomes_filtros->filtro_email = '';
      $infra_filtro->ordem_default = 'name';

      $infra_filtro->preparar_filtros();

      // monta os filtros
      if ( $infra_filtro->inputs->filtro_name != '' ) {         
         $filtro[] = "( name like '%{$infra_filtro->inputs->filtro_name}%' )";
      }
      if ( $infra_filtro->inputs->filtro_email != '' ) {
         $filtro[] = "email LIKE '%{$infra_filtro->inputs->filtro_email}%'";
      }
    
      $resultado->where  = count($filtro)>0 ? join( ' AND ', $filtro ) : TODOS_REGISTROS;
      $resultado->ordem  = $infra_filtro->ordem;
      $resultado->inputs = $infra_filtro->inputs;
    
      $this->x = $resultado->inputs;
           
   } // obter_filtro

   /**
   *  Imprime os registros da grid
   */   
   public function imprimir() {
      $filtro = array();
      Infra_Filtro::obter_array_filtros( $filtros );   
      if ( $filtros->inputs->filtro_name != '' ) {         
         $filtro[] = "( name like '%{$filtros->inputs->filtro_name}%' )";
      }
      if ( $filtros->inputs->filtro_email != '' ) {
         $filtro[] = "email LIKE '%{$filtros->inputs->filtro_email}%'";
      }
      $where = count($filtro)>0 ? join( ' AND ', $filtro ) : TODOS_REGISTROS;
      $ordem = $filtros->ordem;
      $rs = DB::select( " SELECT * FROM users WHERE ".$where ." ORDER BY ". $ordem ) ;
 
      $rel = new Infra_Relatorio();
      $rel->titulo = 'Usuários';
      $rel->AliasNbPages();
      $rel->AddPage();
     
      $rel->SetFont('Times', 'B', 12);
      $rel->Cell( 60, 2,  utf8_decode('Nome'  ), 0, 0, 'L');
      $rel->Cell( 80, 2,  utf8_decode('Email' ), 0, 0, 'L');
      $rel->Line( 205, 27, 5, 27 );
      $rel->SetFont('Arial', '', 11);            
      foreach ( $rs as $index => $registro) {
         $rel->Ln( 7 );
         $rel->Cell( 60, 8, $registro->name,     0, 0, 'L');
         $rel->Cell( 80, 8, utf8_decode($registro->email),  0, 0, 'L');
      }
      $rel->Output();      
   } // imprimir

} // UserController
