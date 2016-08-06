<?php
namespace App\Http\Controllers;

use App\Core\Repositories\FornecedorRepository;

use App\Fornecedor;

use App\Core\Infra\Infra_Filtro;

use Illuminate\Http\Request;
use Input;

/**************************************************************************************************
*
* Cadastro de Fornecedor
*
* objetivo: Cadastrar os fornecedores
*
***************************************************************************************************/

class FornecedorController extends MeuController {

   protected $FornecedorRepository;

   /**
   * Create a new  instance.
   * @return void
   */
   public function __construct( FornecedorRepository $fornecedor_repository ) {
      parent::__construct();
      $this->FornecedorRepository = $fornecedor_repository;
   } // __construct

   /**
   * Exibe o grid
   */
   public function exibir_grid() {
      $this->FornecedorRepository->obter_filtro( $resultado );      
      $data = Fornecedor::whereRaw( $resultado->where )                     
                      ->orderBy( $resultado->ordem )
                      ->paginate( $this->registros_por_pagina );
   
      return view( 'fornecedor.fornecedor_grid' )->with( 'data', $data )
                                 ->with( 'filtros', $resultado->inputs );
   } // exibir_grid

   /**
   * Exibe o form
   */
   public function exibir_form( $acao, $id = null ) {      
      Infra_Filtro::manter_filtros( 'S' );
      $this->FornecedorRepository->acao = $acao;      
      $this->FornecedorRepository->igualar_formulario( $data, $id );

      return view( 'fornecedor.fornecedor_form' )->with( 'data',     $data  )
                                 ->with( 'acao',     $acao  );
   } // exibir_form   

   /**
   * Confirma a Inclusao, alteração e exclusão
   */
   public function Confirmar( Request $request ) {     
      switch ( Input::get('acao') ) {
         case 'incluir':
            $this->FornecedorRepository->Incluir( Input::all() );
            break;
         
         case 'alterar':         
            $this->FornecedorRepository->Alterar( Input::all() );
            break;
         
         case 'excluir':
            $this->FornecedorRepository->Excluir( Input::get('id_fornecedor') );
            break;
               
         default:
            break;
      }

      if ( !$this->FornecedorRepository->tudo_ok ) {
          $data = (object)Input::all();          
          return view( 'fornecedor.fornecedor_form' )->with( 'data',  $data )
                                                     ->withErrors( $this->FornecedorRepository->validacao   );
      }
      return redirect( 'fornecedor' );
   } // Confirmar

   /**
   * Define as regras de validação
   *
   * @return void
   */
   public function definir_regras() {  
      $id_fornecedor = Input::get('id_fornecedor');
      $this->regras =[ 'codigo' => 'required|min:2|max:20|unique:tbfornecedor',
                       'nome'   => 'required',
                    ];      
   } // definir_regras

   public function cancelar() {      
      return redirect( 'fornecedor' );
   } // cancelar

   /**
   * obtém os filtros
   */
   public function obter_filtroxxxxxxxxxxxxxxxxxxxxxxxxxxxx( &$resultado ) {
      $filtro = array();      
      $resultado = new \stdClass();

      $infra_filtro = new Infra_Filtro();
      // define os nomes dos filtros
      $infra_filtro->nomes_filtros                           = new \stdClass();
      $infra_filtro->nomes_filtros->filtro_codigo = '';
      $infra_filtro->nomes_filtros->filtro_nome   = '';
      $infra_filtro->ordem_default = 'codigo';

      $infra_filtro->preparar_filtros();

      // monta os filtros
      if ( $infra_filtro->inputs->filtro_codigo != '' ) {         
         $filtro[] = "( codigo like '%{$infra_filtro->inputs->filtro_codigo}%' )";
      }
      if ( $infra_filtro->inputs->filtro_nome != '' ) {
         $filtro[] = "nome LIKE '%{$infra_filtro->inputs->filtro_nome}%'";
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
      $this->FornecedorRepository->imprimir();
   }

} // FornecedorController
