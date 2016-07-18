<?php 
namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use DB;

class Model_Auxiliar extends Model {   

    public function __construct() {
    }

   /**
   * Busca o registro e seus relacionamentos
   *
   * @param  int  $id
   * @param  int  $outro_campo  
   * @param  boolean busca tabelas relacionadas
   * @return object   
   */
   public function buscarxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx( $id, $outro_campo = null, $buscar_relacionados = true ) {
      $resultado = new \stdClass();
      $model_principal = array(substr($this->table,2));
      $this->obter_nomes_campos( $nomes_campos, $model_principal );      
      // busca o model principal
      if ( $outro_campo == null ) {
         $_this = $this->findOrNew( $id );
         $resultado->achou = $_this->attributes ? true : false;
      } else {
         $_this = $this->where( $outro_campo, $id )->first();         
         $resultado->achou = isset($_this->attributes)  ? true : false;
      }
      foreach ( $nomes_campos as $nome_campo ) {         
         $resultado->$nome_campo = $resultado->achou ? $_this->$nome_campo : null;
      }
      // busca os models relacionados
      if ( $buscar_relacionados ) {         
         foreach ( $this->get_models_relacionados() as $nome_model ) { 
            $this->obter_nomes_campos( $nomes_campos,  array($nome_model) );         
            foreach ( $nomes_campos as $nome ) {
               $resultado->$nome = $resultado->achou ? $_this->$nome_model->$nome : null;
            }
         }
      }
      dd($resultado);
      return $resultado;
   }  // buscar
  
   /*
   * Obtem os nomes dos atributos da tabela 
   * @param  array nome(s) dos model(s)
   *
   * @return array
   */
   public function obter_nomes_camposxxxxxxxxxxxxxx( &$colunas,  $tabelas ) {
      $colunas = array();
      foreach( $tabelas as $tabela ) {
         $query = "SHOW COLUMNS FROM tb{$tabela}";
         $column_name = 'Field';         
         foreach( DB::select($query) as $coluna ) {         
            $colunas[] = $coluna->Field;
         }
      }       
   } // obter_nomes_campos

}

