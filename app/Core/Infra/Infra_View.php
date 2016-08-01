<?php
namespace App\Core\Infra;

/******************************************************************************************************
*
* Classe Infra_View
*
* auxilia as views
* 
*
******************************************************************************************************/

class Infra_View {

   /**
   * Obter título
   *
   * @param  string   $acao
   * @return string
   */
   public static function obter_titulo( $acao ) {
      $resultado = null;
      switch ( $acao ) {
         case 'incluir':
            $resultado = 'Inclusão';
            break;
         case 'alterar':
            $resultado = 'Alteração';
            break;
         case 'consultar':
            $resultado = 'Consulta';
            break;
         case 'excluir':
            $resultado = 'Exclusão';
            break;
         break;
      }     
      return $resultado;
   } // obter_titulo
   
} // Infra_View
