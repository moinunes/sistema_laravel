<?php
namespace App\Http\Controllers;

use App\Core\Repositories\GrupoRepository;

use App\Grupo;

use App\Core\Infra\Infra_Filtro;

use Illuminate\Http\Request;
use Input;
use Session;

/**************************************************************************************************
*
* Cadastro de Grupos
*
* objetivo: Cadastrar os Grupos de usuários
*
***************************************************************************************************/

class GrupoController extends MeuController {

   protected $GrupoRepository;

   /**
   * Create a new  instance.
   * @return void
   */
   public function __construct( GrupoRepository $grupo_repository ) {
      $this->GrupoRepository = $grupo_repository;
   } // __construct

   /**
   * Exibe o grid
   */
   public function exibir_grid() {
      $this->GrupoRepository->obter_filtro( $resultado );      
      $data = Grupo::whereRaw( $resultado->where )                     
                      ->orderBy( $resultado->ordem )
                      ->paginate( $this->registros_por_pagina );
   
      return view( 'grupo.grupo_grid' )->with( 'data', $data )
                                       ->with( 'filtros', $resultado->inputs );
   } // exibir_grid

   /**
   * Exibe o form
   */
   public function exibir_form( $acao, $id = null ) {
      Infra_Filtro::manter_filtros( 'S' );
      $this->GrupoRepository->acao = $acao;

      $this->GrupoRepository->igualar_formulario( $data, $id );
//dd($data);
      $this->GrupoRepository->obter_usuarios_disponiveis( $usuarios_disponiveis,   $id );
      $this->GrupoRepository->obter_usuarios_selecionados( $usuarios_selecionados, $id );     

     
      return view( 'grupo.grupo_form' )->with( 'data', $data )
                                              ->with( 'acao', $acao )
                                              ->with( 'usuarios_disponiveis',$usuarios_disponiveis )
                                              ->with( 'usuarios_selecionados',$usuarios_selecionados );
   } // exibir_form

   /**
   * Confirma a Inclusao, alteração e exclusão
   */
   public function Confirmar( ) {
      
      //$this->data = $request->all();
     // $id         = $request->get('id');        
         
        //dd( Input::all() );
      switch ( Input::get('acao') ) {
         case 'incluir':
         //dd(' fim ');
            $this->GrupoRepository->Incluir( Input::all() );

            break;
         
         case 'alterar':         
            $this->GrupoRepository->Alterar( Input::all() );
            break;
         
         case 'excluir':
            $this->GrupoRepository->Excluir( Input::get('id_grupo') );
            break;
               
         default:
            break;
      }
     if ( !$this->GrupoRepository->tudo_ok ) {
         $data = (object)Input::all(); 
        //dd($data);
          $this->GrupoRepository->obter_usuarios_disponiveis_selecionados( $usuarios_selecionados, Input::get('txt_usuarios_selecionados') );
          $this->GrupoRepository->obter_usuarios_disponiveis_selecionados( $usuarios_disponiveis,  Input::get('txt_usuarios_disponiveis' ) );        
          return view( 'grupo.grupo_form' )->with( 'data',  $data )
                                           ->withErrors( $this->GrupoRepository->validacao   )
                                           ->with( 'usuarios_disponiveis',  $usuarios_disponiveis  )
                                           ->with( 'usuarios_selecionados', $usuarios_selecionados );
     
      }

      return redirect( 'grupo' );      

   } // Confirmar

   /**
   * Iguala o Objeto
   */
   public function igualar_objeto( &$grupo ) {
      $grupo->grupo     = Input::get('grupo');
      $grupo->descricao = Input::get('descricao');
   } // igualar_objeto

  

   public function cancelar( ) {      
      return redirect( 'grupo' );
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
      $infra_filtro->nomes_filtros->filtro_grupo = '';
      $infra_filtro->nomes_filtros->filtro_descricao = ''; 
      $infra_filtro->ordem_default = 'grupo';
      $infra_filtro->preparar_filtros();

      // monta os filtros
      if ( $infra_filtro->inputs->filtro_grupo != '' ) {         
         $filtro[] = "( grupo like '%{$infra_filtro->inputs->filtro_grupo}%' )";
      }
      if ( $infra_filtro->inputs->filtro_descricao != '' ) {         
         $filtro[] = "( descricao like '%{$infra_filtro->inputs->filtro_descricao}%' )";
      }
      $resultado->where  = count($filtro)>0 ? join( ' AND ', $filtro ) : TODOS_REGISTROS;
      $resultado->ordem  = $infra_filtro->ordem;
      $resultado->inputs = $infra_filtro->inputs;
   } // obter_filtro

   /**
   *  Imprime os registros da grid
   */   
   public function imprimir() {
      $filtro = array();
      Infra_Filtro::obter_array_filtros( $filtros );   
      if ( $filtros->inputs->filtro_grupo != '' ) {         
         $filtro[] = "( grupo like '%{$filtros->inputs->filtro_grupo}%' )";
      }
      if ( $filtros->inputs->filtro_descricao != '' ) {
         $filtro[] = "descricao LIKE '%{$filtros->inputs->filtro_descricao}%'";
      }
      $where = count($filtro)>0 ? join( ' AND ', $filtro ) : TODOS_REGISTROS;
      $ordem = $filtros->ordem;
      $rs = DB::select( " SELECT * FROM tbgrupo WHERE ".$where ." ORDER BY ". $ordem ) ;
 
      $rel = new Infra_Relatorio();
      $rel->titulo = 'Grupo';
      $rel->AliasNbPages();
      $rel->AddPage();
     
      $rel->SetFont('Times', 'B', 12);
      $rel->Cell(20, 2,  utf8_decode('Grupo'     ), 0, 0, 'L');
      $rel->Cell(80, 2,  utf8_decode('Descrição' ), 0, 0, 'L');
      $rel->Line( 205, 27, 5, 27 );
      $rel->SetFont('Arial', '', 11);            
      foreach ( $rs as $index => $registro) {
         $rel->Ln( 7 );
         $rel->Cell(20, 8, $registro->grupo,     0, 0, 'L');
         $rel->Cell(80, 8, utf8_decode($registro->descricao),  0, 0, 'L');
      }
      $rel->Output();
      
   } // imprimir

   
   

   

} // GrupoController