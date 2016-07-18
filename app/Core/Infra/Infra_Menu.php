<?php
namespace App\Core\Infra;

use DB;

/*
* Classe helper para auxiliar nas views da aplicação 
*
*
*/

class Infra_Menu {

   /**
   * Obter título
   *
   * @param  string   $acao
   * @return string
   */
   public function montar_menu() {      
      $this->obter_menus_superior( $menu_superior );
      echo '<nav id="menu-wrap">';
      echo '<ul id="menu">';
      echo '<li><a href="/">Home</a></li>';
      foreach( $menu_superior as $superior ) {         
         $this->obter_menus_itens( $menu_itens, $superior->id_menu );         
         echo '<li><a href="#">'.$superior->titulo.'</a>';
         echo '<ul>';
         foreach( $menu_itens as $item ) {
            echo "<li><a href='/$item->rota'>".$item->titulo."</a></li>";
         }         
         echo '</ul>';
      }
      echo '<li><a href="/logout">Sair</a></li>';
      echo '</ul>';
      echo '</nav>';
   } // montar_menu

   /**
   * Obtém os menus superiores
   */
   public function obter_menus_superior( &$resultado ) {
      $resultado = DB::select(' SELECT id_menu, titulo FROM tbmenu WHERE id_pai is null ' );
   } // obter_menus_superior

   /**
   * Obtém os itens de menus
   */
   public function obter_menus_itens( &$resultado, $id ) {
      $sql = " SELECT id_menu, titulo, rota, acao 
               FROM tbmenu  
               WHERE id_pai = $id
               ORDER BY posicao
             ";
      $resultado = DB::select($sql);
   } // obter_menus_itens  

}
