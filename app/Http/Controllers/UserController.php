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
        //dd($data);
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


   public function cancelar() {
      return redirect( 'user' );
   } // cancelar

   
   
} // UserController
