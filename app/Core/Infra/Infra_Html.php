<?php
namespace App\Core\Infra;

use DB;
use Request;

/******************************************************************************************************
*
* Classe Infra_Html
*
* auxilia nos códigos HTML
*
******************************************************************************************************/

class Infra_Html {

   protected static $errors;
   
   public static function set_errors($valor) { 
      self::$errors = $valor; 
   }
   
   public static function get_errors() { 
      return self::$errors; 
   }

   /**
   * Cria um link
   * obs: cria somente se o usuário logado tiver permissão de acesso
   *
   * @param    string     acao
   * @param    int        id
   * @return   void
   */
   public static function criar_link_com_permissao( $acao, $id = null ) {
      if ( Infra_Permissao::tem_permissao( $acao ) ) {
         self::obter_classe( $classe, $acao );
         $url = Request::url();
         $url = "$url/$acao/$id";      
         echo "<a href='$url'><span class='$classe'></span></a>&nbsp;&nbsp;";
      }
   } // criar_link

   /**
   * Obtém a classe para o link
   *
   * @param    string     acao
   * @return   string     classe
   */
   protected static function obter_classe( &$classe, $acao ) {
      $classe = '';
      switch ( $acao ) {
         case 'incluir':
            $classe = "btn_incluir glyphicon glyphicon-plus";
            break;

         case 'consultar':
            $classe = "glyphicon glyphicon-search";
            break;
         
         case 'alterar':
            $classe = "glyphicon glyphicon-pencil";
            break;

         case 'excluir':
            $classe = "glyphicon glyphicon-trash";
            break;
         
         case 'imprimir':
            $classe = "glyphicon glyphicon-print";
            break;
         
         default:            
            break;
      }
   } // obter_classe

   /**
   * Cria título com link para uma grid
   *
   * @param    string     título da coluna
   * @param    string     ordenar a coluna da grid
   * @return   void
   */
   public static function criar_titulo_grid( $titulo, $ordem = null ) {      
      $url = Request::url();      
      $url = "$url/?ordem=$ordem";      
      echo "<a href='$url'>$titulo</a>&nbsp;&nbsp;";
   } // criar_titulo_grid

   /**
   * Cria input text
   *
   * @param    string     name
   * @param    string     valor
   * @param    int        size
   * @param    int        maxlength
   * @param    string     readonly
   * @return   void
   */
   public static function input_text( $name, $value, $size = 10, $maxlength = 10, $readonly = null ) {
      echo "<input type='text' id='$name' name='$name' value='$value' size='$size' maxlength='$maxlength' $readonly  >";
   } // input_text

   /**
   * Cria input text password
   *
   * @param    string     name
   * @param    string     valor
   * @param    int        size
   * @param    int        maxlength
   * @param    string     readonly
   * @return   void
   */
   public static function input_password( $name, $value, $size = 10, $maxlength = 10, $readonly = null ) {
      echo "<input type='password' id='$name' name='$name' value='$value' size='$size' maxlength='$maxlength' $readonly  >";
   } // input_password

   /**
   * Cria input hidden
   *
   * @param    string     name
   * @param    string     valor
   * @return   void
   */
   public static function input_hidden( $name, $value ) {
      echo "<input type='hidden' id='$name' name='$name' value='$value' >\n";
   } // input_hidden

   /**
   * Cria input submit
   *
   * @param    string     título
   * @param    string     classe
   * @return   void
   */
   public static function input_submit( $titulo, $classe ) {
      $classe = "btn btn-success $classe";
      echo "<button type='submit' class='$classe'>$titulo</button>";
   } // cinput_submit

   /**
   * Cria a tag form
   *
   * @param    string     título
   * @param    string     classe
   * @return   void
   */
   public static function Form( $name, $method="post", $valid=null, $classe='col-sm-12 form-horizontal' ) {
      $url = Request::url();
      if ($valid) {
         $valid = 'javascript::$valid';
      }
      echo "<form name='$name' action='$url' method='$method' $valid  class='$classe'  >";
   } // Form

   /**
   * Exibi o titulo do formulário
   *
   * @param    string     titulo
   * @param    string     acao
   * @return   void
   */
   public static function exibir_titulo_form( $titulo, $acao) {
      $resultado = Infra_View::obter_titulo($acao);
      $div       = "<div class='div_titulo'>$resultado - $titulo</div>";
      echo "$div\n";
   } // exibir_titulo_form
 
   /**
   * Exibi a string '* campos_obrigatorios'
   * @return   void
   */
   public static function exibir_string_campos_obrigatorios() {
      $texto = "
         <table border='0' width='100%'>
            <tr>
               <td align='right'>* campos obrigatórios</td>
            </tr>
         </table>
      ";      
      echo "$texto\n";
   } // exibir_string_campos_obrigatorioso
   
   /**
   * Retorna a classe para os campos obrigatórios
   *
   * @param    string     nome do campo text
   * @return   string
   */
   public static function obrigatorio( $text ) {
      $erros = self::get_errors();
      $classe = $erros->has( $text ) ?  " cor_vermelha" : '';
      return $classe;
   } // obrigatorio

} // Infra_Html
