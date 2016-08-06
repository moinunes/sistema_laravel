<?php 
namespace App;

class Produto extends Model_Auxiliar {   

   protected $table      = 'tbproduto';
   protected $primaryKey = 'id_produto';
   protected $fillable   = [ 'id_produto', 'codigo', 'descricao', 'quantidade', 'preco', 'id_fornecedor' ];   

   public function __construct() {

   }

   /**
   * Define os models relacionados
   * @return array
   */
   public function get_models_relacionados() {
      return array( "fornecedor" );
   }

   /**
   * Obtém relacionamento com fornecedor
   */
   public function fornecedor() {
     return $this->hasOne( 'App\Fornecedor','id_fornecedor','id_fornecedor' );
   }
   
} // Produto

