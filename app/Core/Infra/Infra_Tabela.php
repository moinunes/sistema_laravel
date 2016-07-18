<?php
namespace App\Core\Infra;

use DB;

/*
* Classe para auxiliar
*
*/

class Infra_Tabela {
  
   /*
   * Obtem as colunas da tabela 
   *   -> nome, tipo e tamanho
   * @return array
   */
   public function obter_schema_tabela( &$colunas,  $nome_tabela ) {
      switch (DB::connection()->getConfig('driver')) {
         case 'pgsql':
            $query = "SELECT column_name FROM information_schema.columns WHERE table_name = '".$nome_tabela."'";
            $column_name = 'column_name';
            $reverse = true;
            break;

         case 'mysql':
            $query = 'SHOW COLUMNS FROM '.$nome_tabela;
            $column_name = 'Field';
            $reverse = false;           
            break;
      }
      $columns = array();
      foreach(DB::select($query) as $column ) {
         $columns[] = $column;
      }
      if( $reverse ) {
         $columns = array_reverse($columns);
      }
      $colunas =  $columns;
   }

   /*
   * Obtem os nomes dos atributos da tabela 
   *
   * @return array
   */
   public function obter_nomes_campos( &$colunas,  $tabelas ) {
      $colunas = array();
      foreach( $tabelas as $tabela ) {
         $query = 'SHOW COLUMNS FROM '.$tabela;
         $column_name = 'Field';         
         foreach( DB::select($query) as $coluna ) {         
            $colunas[] = $coluna->Field;
         }
      }       
   }
   
}
