<?php
namespace App\Core\Infra;

use DB;
use Auth;
use Input;
use Request;
use App\User;


/*
* Classe Infra_Permissao
* 
* verifica as permissões dos usuários

* @author Moisés Nunes
*
*/

class Infra_Permissao {

   static function obter_permissao( &$resultado, $id_grupo, $id_menu ) {
      $resultado = false;
      $query = DB::select( " SELECT id_grupo,id_menu
                             FROM tbpermissao                            
                             WHERE id_grupo = :id_grupo AND id_menu = :id_menu", [ 'id_grupo' => $id_grupo, 'id_menu' => $id_menu ] );
      if($query) {
         print 'xx';
         $resultado=true;
      
      }      
      return $resultado;
    } 
      
   /**
   * Obtém os menus superiores e Permissões
   *
   * @param    int        id do grupo
   * @return   array      resultado
   */
   public function obter_menus_superior( &$resultado, $id_grupo ) {
   	$sql = " SELECT tbmenu.id_menu      AS id_menu, 
                      tbmenu.titulo  AS titulo,
                      tbpermissao.id_permissao AS permite
               FROM tbmenu
                  LEFT JOIN tbpermissao ON (tbpermissao.id_menu = tbmenu.id_menu ) AND 
                                            tbpermissao.id_grupo = '{$id_grupo}'
               WHERE tbmenu.id_pai IS NULL 
               ORDER BY tbmenu.id_menu";
      $resultado = DB::select( $sql );
   }  // obter_menus_superior

   /**
   * Obtém os Itens de menus superiores e Permissões
   *
   * @param    int        id do menu
   * @param    int        id do grupo
   * @return   array      resultado
   */
   public function obter_menus_itens( &$resultado, $id_menu, $id_grupo ) {
       $sql= " SELECT tbmenu.id_menu           AS id_menu, 
                      tbmenu.titulo            AS titulo,
                      tbpermissao.id_permissao AS permite
               FROM tbmenu  
                  LEFT JOIN tbpermissao ON ( tbpermissao.id_menu = tbmenu.id_menu ) AND 
                                                              tbpermissao.id_grupo = '{$id_grupo}'
               WHERE id_pai = '{$id_menu}' 
               ORDER BY tbmenu.id_menu";
      $resultado = DB::select( $sql );
   } // obter_menus_itens


   /**
   * Valida se o usuário tem permissão de acesso
   *
   * @param    string     acao   
   * @return   boolean    
   */   
   public static function tem_permissao( $acao = null ) {
      $resultado = false;      
      $rota      = Request::segment(1);
      

      print 'rota:'.$rota;
      print_r( input::all() );

      // insira aqui as ROTAS com acesso liberado.
      if ( $rota == '' || $rota == 'home' || $rota == 'busca' ||  $rota == 'login' ||  $rota == 'logout' ) {
         return true;
      }

      // rota 'tools' - somente para usuário master
      if ( $rota == 'tools' && Auth::user()->master=='S' ) {
         return true;
      }

      // obtém o id do menu
      Infra_Permissao::obter_id_menu( $id_menu, $rota, $acao );
      if ( $id_menu == '' ) {         
         dd( 'id_menu não encontrado - problemas na tabela: tbmenus' );
      }      
      
      // valida a permissão
      Infra_Permissao::obter_grupos_do_usuario( $grupos );
      foreach ( $grupos as $indice => $item ) {
         if ( self::permite_acesso( $item->id_grupo, $id_menu ) ) {
            $resultado = true;
            break;
         }
      }

       // usuario magda não tem permissao nenhuma
        //nem a /permissao/negada?rota=permissao    - deveria deixar livre:  /permissao/negada
       //dd('vixi');      


      return $resultado;
   } // tem_permissao

   /**
   * Obtém o id do menu a ser acessado pelo usuário logado
   *
   * @param    string     rota   
   * @param    string     acao   
   * @return   int        id do menu    
   */   
   protected static function obter_id_menu( &$id_menu, $rota, $acao = null ) {
      $id_menu = '';
      if ( $acao == null ) {
         $registro = DB::select( " SELECT id_menu FROM tbmenu WHERE rota = :rota", [ 'rota' => $rota ] );
      } else {
         $registro = DB::select( " SELECT id_menu FROM tbmenu WHERE rota = :rota AND acao = :acao", [ 'rota' => $rota, 'acao' => $acao ] );
      }      
      if ( $registro ) {
         $registro = (object)$registro[0];
         $id_menu = $registro->id_menu;       
      }
   } // obter_id_menu

   /**
   * Obtém os grupos do usuário logado
   *
   * @return   array        grupos  
   */   
   protected static function obter_grupos_do_usuario( &$resultado ) {     
      $user = Auth::user();
      
      //$id_user = Auth::user->id;
      $resultado = false;
      $resultado = DB::select( " SELECT id_grupo,id_user
                                 FROM tbgrupo_user                                    
                                 WHERE id_user = :id_user", [ 'id_user' => $user->id ] );   
      return $resultado;
   } // obter_grupos_do_usuario

   /**
   * Verifica se o acesso está liberado
   *
   * @param    int        id do grupo
   * @param    int        id do menu
   * @return   boolean
   */   
   protected static function permite_acesso( $id_grupo, $id_menu ) {      
      $resultado = false;
      $query = DB::select( " SELECT id_grupo,id_menu
                                 FROM tbpermissao
                                 WHERE id_grupo = :id_grupo AND id_menu = :id_menu", [ 'id_grupo' => $id_grupo, 'id_menu' => $id_menu ] );      
      if ( $query ) {
         $resultado = true;
      } 
      return $resultado;
   } // permite_acesso

} // Infra_Permissao