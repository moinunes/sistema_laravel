<?php 
namespace App;

class Fornecedor extends Model_Auxiliar {

   protected $table      = 'tbfornecedor';
   protected $primaryKey = 'id_fornecedor';   
   protected $fillable   = [ 'id_fornecedor','codigo_fornecedor','nome_fornecedor' ];
   
   public function __construct() {      
   }
 
   /**
   * Define os models relacionados
   * @return array
   */
   public function get_models_relacionados() { 
      return array();
   }

} // Fornecedor

