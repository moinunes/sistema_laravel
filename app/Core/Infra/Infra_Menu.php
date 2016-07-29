<?php
namespace App\Core\Infra;

use DB;

/******************************************************************************************************
*
* Classe Infra_Menu
*
* auxilia na montagem do menu da aplicação
*
******************************************************************************************************/

class Infra_Menu {

   /**
   * Monta o menu da aplicação
   *
   * @return void
   */
   public function montar_menu() {      
      $this->obter_menus_superiores( $menu_superior );
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
   *  exemplo: AUXILIARES - ADMINISTRATIVOS
   */
   public function obter_menus_superiores( &$resultado ) {
      $resultado = DB::select(' SELECT id_menu, 
                                       titulo 
                                FROM tbmenu 
                                WHERE id_pai is null ' );
   } // obter_menus_superior

   /**
   * Obtém os itens de menus
   * @param    int     id_menu   
   */
   public function obter_menus_itens( &$resultado, $id ) {
      $sql = " SELECT id_menu, 
                      titulo, 
                      rota, 
                      acao 
               FROM tbmenu  
               WHERE id_pai = $id
               ORDER BY posicao
             ";
      $resultado = DB::select($sql);
   } // obter_menus_itens  

   /**
   * Obtém o id_menu que está sendo acessado pelo usuário logado
   *
   * @param    string     rota   
   * @param    string     acao
   *
   * @return   int        id do menu    
   */   
   public static function obter_id_menu( &$id_menu, $rota, $acao = null ) {
      $id_menu = '';
      if ( $acao == null ) {
         $registro = DB::select( " SELECT id_menu 
                                   FROM tbmenu 
                                   WHERE rota = :rota", [ 'rota' => $rota ] );
      } else {
         $registro = DB::select( " SELECT id_menu 
                                   FROM tbmenu 
                                   WHERE rota = :rota AND 
                                         acao = :acao", [ 'rota' => $rota, 'acao' => $acao ] );
      }      
      if ( $registro ) {
         $registro = (object)$registro[0];
         $id_menu  = $registro->id_menu;
      }
   } // obter_id_menu

} // Infra_Menu