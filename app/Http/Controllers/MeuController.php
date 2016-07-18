<?php 
namespace App\Http\Controllers;

use Validator;



/**************************************************************************************************
*
* MeuController
* 
* objetivo: Auxiliar os demais controllers da aplicação
*
*
***************************************************************************************************/

define( "TODOS_REGISTROS", '1=1' );
define( "NENHUM_REGISTRO", '1=2' );

class MeuController extends Controller {

   /**
   * Guarda a acao ( incluir, alterar, excluir, consultar, imprimir )
   */   
   public $acao;

   /**
   * Guarda os nomes dos campos ou inputs
   */   
   public $data;

   /**
   * Guarda as regras de validação
   */   
   //public $regras;
   
   /**
   * Define o total de registro do paginator
   */   
   public $registros_por_pagina = 6;
   
   /**
   * Create a new controller instance.
   * @return void
   */
   public function __construct() {      
      // se o usuário não tiver logado, redireciona para o login
      $this->middleware( 'auth' );
     

   } // __construct
   
   /**
   * Valida os dados antes de persitir
   *    - se falhar, guarda o resultado em $this->validator
   * @return boolean
   */
   public function Validarxxxxxxxxxxx() {
      $resultado = true;     
      if( $this->acao == 'incluir' || $this->acao == 'alterar' ) {
         $this->definir_regras();
         $this->validator = Validator::make( $this->data, $this->regras );
         if ( $this->validator->fails() ) {
            $resultado = false;
         }
      }      
      return $resultado;
   } // Validar
      
} // MeuController