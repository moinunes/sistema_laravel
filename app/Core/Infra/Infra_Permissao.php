<?php
namespace App\Core\Infra;

use DB;
use Auth;
use Input;
use Request;
use App\User;

/******************************************************************************************************
*
* Classe Infra_Permissao
* 
* valida as permissões do usuário
*
******************************************************************************************************/

class Infra_Permissao {

   /**
   * Define as rotas de livre acesso 
   *   
   */   
   private static $_rotas_livre_acesso = array ( '', 'home', 'busca', 'login', 'logout' );     

   /**
   * Valida se o usuário tem permissão de acesso
   *
   * @param    string     acao
   * @return   boolean
   */   
   public static function tem_permissao( $acao = null ) {
      $rota = Request::segment(1);
      if ( in_array( $rota, self::$_rotas_livre_acesso ) ) { 
         return true;
      }      
      if ( $rota == 'tools' ) {
         return Auth::user()->master == 'S' ? true : false;
      }

      Infra_Menu::obter_id_menu( $id_menu, $rota, $acao );
      if ( $id_menu == '' ) {         
         dd( 'id_menu não encontrado - problemas na tabela: tbmenus' );
      }

      Infra_Permissao::obter_grupos_do_usuario_logado( $grupos );      
      foreach ( $grupos as $indice => $item ) {
         if ( self::permite_acesso( $item->id_grupo, $id_menu ) ) {
            return true;
            break;
         }
      }
      
      return false;

   } // tem_permissao
   
   /**
   * Obtém os grupos do usuário logado
   *
   * @return   array        grupos  
   */   
   protected static function obter_grupos_do_usuario_logado( &$resultado ) {     
      $user = Auth::user();            
      $resultado = false;
      $resultado = DB::select( " SELECT 
                                    id_grupo,
                                    id_user
                                 FROM tbgrupo_user                                    
                                 WHERE id_user = :id_user", [ 'id_user' => $user->id ] );   
      return $resultado;
   } // obter_grupos_do_usuario_logado

   /**
   * Verifica se o acesso está liberado
   *
   * @param    int        id_grupo
   * @param    int        id_menu
   * @return   boolean
   */   
   protected static function permite_acesso( $id_grupo, $id_menu ) {
      $resultado = false;
      $query = DB::select( " SELECT id_grupo,id_menu
                             FROM tbpermissao
                             WHERE id_grupo = :id_grupo AND 
                                   id_menu  = :id_menu", [ 'id_grupo' => $id_grupo, 'id_menu' => $id_menu ] );
      if ( $query ) {
         $resultado = true;
      } 
      return $resultado;
   } // permite_acesso

   /**
   * Obtém a permissão por item de menu
   *
   * @param    int        id_grupo
   * @param    int        id_menu
   * @return   boolean
   */      
   public static function obter_permissao( &$resultado, $id_grupo, $id_menu ) {
      $resultado = false;
      $query = DB::select( " SELECT 
                                    id_grupo,
                                    id_menu
                             FROM tbpermissao                            
                             WHERE id_grupo = :id_grupo AND 
                                   id_menu  = :id_menu", [ 'id_grupo' => $id_grupo, 'id_menu' => $id_menu ] );
      if($query) {
         $resultado = true;      
      }      
      return $resultado;
    } 
      
   /**
   * Obtém os menus superiores verificando 'se tem Permissão'
   *
   * @param    int        id do grupo
   * @return   array      resultado
   */
   public function obter_menus_superior( &$resultado, $id_grupo ) {
   	$sql = " SELECT tbmenu.id_menu           AS id_menu, 
                      tbmenu.titulo            AS titulo,
                      tbpermissao.id_permissao AS permite
               FROM tbmenu
                  LEFT JOIN tbpermissao ON (tbpermissao.id_menu  = tbmenu.id_menu ) AND 
                                            tbpermissao.id_grupo = '{$id_grupo}'
               WHERE tbmenu.id_pai IS NULL 
               ORDER BY tbmenu.id_menu";
      $resultado = DB::select( $sql );
   }  // obter_menus_superior

   /**
   * Obtém os Itens de menus verificando 'se tem Permissão'
   *
   * @param    int        id do menu
   * @param    int        id do grupo
   * @return   array      resultado
   */
   public function obter_menus_filhos( &$resultado, $id_menu, $id_grupo ) {
       $sql= " SELECT tbmenu.id_menu           AS id_menu, 
                      tbmenu.titulo            AS titulo,
                      tbpermissao.id_permissao AS permite
               FROM tbmenu  
                  LEFT JOIN tbpermissao ON ( tbpermissao.id_menu  = tbmenu.id_menu ) AND 
                                             tbpermissao.id_grupo = '{$id_grupo}'
               WHERE id_pai = '{$id_menu}' 
               ORDER BY tbmenu.id_menu";               
      $resultado = DB::select( $sql );
   } // obter_menus_filhos

} // Infra_Permissao