<?php
namespace App\Http\Controllers;


use App\Uf;
use App\Fornecedor;


use Illuminate\Http\Request;
use Input;


/**************************************************************************************************
*
* Busca
*
* objetivo: Montar popup de busca
*
***************************************************************************************************/

class BuscaController extends Controller {   

   /**
   * filtrar
   */
   public function filtrar( Request $request ) {      
      $chamar_funcao = Input::get('acao');
      $this->$chamar_funcao( $data, $inputs  );
      $view = "busca.$chamar_funcao"."_grid";
      return view( $view )->with( 'data',    $data   )
                          ->with( 'filtros', $inputs );
   } // filtrar
   
   /**
   * buscar_fornecedor
   */
   public function buscar_fornecedor( &$data, &$inputs ) {
      $inputs = new \stdClass();      
      $inputs->filtro_codigo_fornecedor = Input::get('filtro_codigo_fornecedor' ) != '' ? Input::get('filtro_codigo_fornecedor' ) : '';
      $inputs->filtro_nome_fornecedor   = Input::get('filtro_nome_fornecedor'   ) != '' ? Input::get('filtro_nome_fornecedor'   ) : '';
      $inputs->order                    = Input::get('order')                     != '' ? Input::get('order')                     : 'nome_fornecedor';
      $filtro = array();
      if ( $inputs->filtro_codigo_fornecedor != '' ) {
         $filtro[] = "( codigo_fornecedor like '%{$inputs->filtro_codigo_fornecedor}%' )";
      }
      if ( $inputs->filtro_nome_fornecedor != '' ) {
         $filtro[] = "nome_fornecedor LIKE '%{$inputs->filtro_nome_fornecedor}%'";
      }
      $filtros = count($filtro)>0 ? join( ' AND ', $filtro ) : '1=1';            
      $data = Fornecedor::whereRaw( $filtros )->orderBy( $inputs->order  )
                                              ->paginate( 100 );
   } // buscar_fornecedor
   
} // BuscaController