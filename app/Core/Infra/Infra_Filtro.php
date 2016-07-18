<?php 
namespace App\Core\Infra;

use DB;
use Auth;
use Request;
use Input;
use Illuminate\Pagination\Paginator;

/**************************************************************************************************
*
* Infra_Filtro
* 
* objetivo: Auxiliar nos filtros de cadastros, relatórios, etc... 
*
*
***************************************************************************************************/

class Infra_Filtro {

   /**
   * Define os nomes dos filtros
   */   
   public $nomes_filtros;

   /**
   * Define os inputs
   */   
   public $inputs;
 
   /**
   * Define a pagina
   */   
   public $page;

   /**
   * Define a ordem DEFAULT dos registros
   */   
   public $ordem_default;

   /**
   * Define a ordem dos registros
   */   
   public $ordem;

   /**
   * Create a new instance.
   * @return void
   */
   public function __construct() {      
   }

   /**
   * Seta a pagina corrente do paginador
   * 
   * @return void
   */   
   public function set_current_page( $page ) {
      Paginator::currentPageResolver( function() use ( $page ) { return $page; });
   } // set_current_page
  
   /**
   * prepara os filtros
   */
   public function preparar_filtros() {
      $this->obter_filtros( $filtros );

      if ( count($filtros)==0 ) {
         $this->incluir_filtros();

      } else if ( $filtros[0]->manter_filtro == 'N' )  {
         if ( count(Input::all())==0  ) {
            $this->excluir_filtros();
            $this->incluir_filtros();
         } else {  
            $this->alterar_filtros();
         }
      }
      $this->set_filtros();
      $this->manter_filtros( 'N' );
   } // preparar_filtros

   /**
   * Alterar os filtros
   * 
   * @return void
   */   
   protected function alterar_filtros() {
      $alterar    = true;
      $controller = Request::segment(1);
      $id_user    = Auth::user()->id;
      $inputs     = new \stdClass(); 
      $str        = '';
      $page       = '';
      $ordem      = '';
       
      $this->obter_filtros( $filtros );
      $filtros = (object)$filtros[0];
         
      
      if ( Input::get('_token') != '' ) {
         $page = 1;
         foreach ( Input::get() as $index => $valor ) {
            if( substr( $index, 0, 6 ) == 'filtro' ) {                    
               $str .=  "$index=>$valor; ";
            }
         }               
      }

      if ( Input::get('page') != '' ) {
         $page = Input::get('page');         
      }      
      
      if ( Input::get('ordem') != '' ) {
         $ordem = Input::get('ordem');         
      }

      if( $alterar ) {
         $str   =  $str   != '' ? $str   : $filtros->inputs;
         $page  =  $page  != '' ? $page  : $filtros->page;
         $ordem =  $ordem != '' ? $ordem : $filtros->ordem;
         $str   = addslashes($str);
         //.. alterar
         $sql = " UPDATE tbfiltro SET inputs = '{$str}', page = '{$page}', ordem = '{$ordem}'
                      WHERE id_user = {$id_user} AND controller = '{$controller}' ";                     
         DB::update( $sql );
      }     
   } // alterar_filtros
   
   /**
   * set filtros
   * 
   * @return void
   */   
   public function set_filtros() {
      $inputs = new \stdClass(); 
      $this->obter_filtros( $filtros );
      $filtros = (object)$filtros[0];

      $todos_inputs = explode( ';', $filtros->inputs );      
      foreach ( $todos_inputs as $indice => $valor) {         
         $registro = explode( '=>', $valor );
         if ( substr(trim($registro[0]),0,6)=='filtro' ) {
            $nome_campo          = trim($registro[0]);
            $valor_campo         = trim($registro[1]);
            $inputs->$nome_campo = $valor_campo;
         } 
      }
      $page  = Input::get('page' ) != '' ? Input::get('page' ) : $filtros->page;
      $ordem = Input::get('ordem') != '' ? Input::get('ordem') : $filtros->ordem;
      $this->set_current_page( $page );
      $this->ordem  = $ordem;
      $this->inputs = $inputs;
   } // set_filtros

     /**
   * inclui os filtros
   * 
   * @return void
   */   
   function incluir_filtros() {
      $id_user    = Auth::user()->id;
      $controller = Request::segment(1);
      $page       = '1';
      $ordem      = $this->ordem_default;
      $inputs     = '';
      foreach ( $this->nomes_filtros as $i => $valor ) {
         $inputs .= "$i=>$valor;";
      }
      $inputs = addslashes( $inputs);
      DB::table('tbfiltro')->insert(
            [ 'id_user'=>$id_user, 'controller'=>$controller, 'page'=>$page, 'ordem'=>$ordem, 'inputs'=>$inputs  ]
      );
   } // incluir_filtros

   /**
   * Exclui os filtros
   * 
   * @return void
   */   
   function excluir_filtros() {
      $this->obter_filtros( $filtros );
      if ( $filtros ) {
         $id      = $filtros[0]->id;      
         $deleted = DB::delete( " DELETE from tbfiltro WHERE id = $id " );
      }
   } // excluir_filtros

   /**
   * mantém os filtros
   *
   * param  $valor    string     
   * 
   * @return void
   */   
   public static function manter_filtros( $valor ) {
      $id_user    = Auth::user()->id;
      $controller = Request::segment(1);
      $sql        = " UPDATE tbfiltro SET manter_filtro = '{$valor}'
                      WHERE id_user = {$id_user} AND controller = '{$controller}' ";                     
      DB::update( $sql );
   }  // manter_filtros

   /**
   * obtém os filtros
   * 
   * @return void
   */   
   public static function obter_filtros( &$filtros ) {  
      $filtros    = array();
      $id_user    = Auth::user()->id;
      $controller = Request::segment(1);
      $filtros    = DB::select(' SELECT * FROM tbfiltro
                                 WHERE id_user = :id_user AND controller = :controller' , 
                                     [ 'id_user' =>  Auth::user()->id, 'controller' => $controller  ] );
   } // obter_filtros

   public static function obter_array_filtros( &$array_filtros ) {
      $array_filtros = new \stdClass();
      $inputs  = new \stdClass(); 
            
      Infra_Filtro::obter_filtros( $filtros );      
      $filtros = (object)$filtros[0];
      
      $todos_inputs = explode( ';', $filtros->inputs );      
      foreach ( $todos_inputs as $indice => $valor) {         
         $registro = explode( '=>', $valor );
         if ( substr(trim($registro[0]),0,6)=='filtro' ) {
            $nome_campo          = trim($registro[0]);
            $valor_campo         = trim($registro[1]);
            $inputs->$nome_campo = $valor_campo;
         } 
      }
        
      $array_filtros->inputs = $inputs;
      $array_filtros->ordem = $filtros->ordem;

   } // obter_array_filtros

} // Infra_Filtro
