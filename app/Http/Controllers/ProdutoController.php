<?php
namespace App\Http\Controllers;

use App\Core\Repositories\ProdutoRepository;

use App\Produto;
use App\Fornecedor;
use App\Core\Infra\Infra_Filtro;


use Illuminate\Http\Request;
use Input;


 //use Illuminate\Database\Query\Builder\merge as merge;

/**************************************************************************************************
*
* Cadastro de Produtos
*
***************************************************************************************************/

class ProdutoController extends MeuController {

   protected $ProdutoRepository;

   /**
   * Create a new  instance.
   * @return void
   */
   public function __construct( ProdutoRepository $produto_repository ) {
      parent::__construct();
      $this->ProdutoRepository = $produto_repository;
   } // __construct

   /**
   * Exibe o grid
   */
   public function exibir_grid() {
      $this->ProdutoRepository->obter_filtro( $resultado );      
      
      $data = Produto::select( 'tbproduto.*',
                               'tbfornecedor.codigo AS fornecedor_codigo',
                               'tbfornecedor.nome AS fornecedor_nome' 
                             )
                       ->join( 'tbfornecedor', 'tbproduto.id_fornecedor', '=', 'tbfornecedor.id_fornecedor')
                       ->whereRaw( $resultado->where )                     
                       ->orderBy( $resultado->ordem )                      
                       ->paginate( $this->registros_por_pagina );
                       
      return view( 'produto.produto_grid' )->with( 'data', $data )
                                           ->with( 'filtros', $resultado->inputs );
   } // exibir_grid

   /**
   * Exibe o form
   */
   public function exibir_form( $acao, $id_produto = null ) {
      Infra_Filtro::manter_filtros( 'S' );
      $this->ProdutoRepository->acao = $acao;
      $this->ProdutoRepository->igualar_formulario( $data, $id_produto );
      return view( 'produto.produto_form' )->with( 'data',     $data  )
                                           ->with( 'acao',     $acao  );
   } // exibir_form

   /**
   * Confirma a Inclusao, alteração e exclusão
   */
   public function Confirmar() {       
      switch ( Input::get('acao') ) {
         case 'incluir':
            $this->ProdutoRepository->Incluir( Input::all() );
            break;
         
         case 'alterar':         
            $this->ProdutoRepository->Alterar( Input::all() );
            break;
         
         case 'excluir':
            $this->ProdutoRepository->Excluir( Input::get('id_produto') );
            break;
               
         default:
            break;
      }

      if ( !$this->ProdutoRepository->tudo_ok ) {
          $data = (object)Input::all();   
          return view( 'produto.produto_form' )->with( 'data',  $data )
                                               ->withErrors( $this->ProdutoRepository->validacao   );
      }

      return redirect( 'produto' );
      
   } // Confirmar 

   public function cancelar() {      
      return redirect( 'produto' );
   } // cancelar
 

   /**
   *  Imprime os registros da grid
   */   
   public function imprimir() {
      $this->ProdutoRepository->imprimir();
   }
   
} // ProdutoController
