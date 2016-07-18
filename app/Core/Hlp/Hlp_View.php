<?php

namespace App\Core\Hlp;

/*
* Classe helper para auxiliar nas views da aplicação 
*
* @author moinunes
*
*/

class Hlp_View {

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
   }
   
} // Hlp_View
