<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbprodutoTable extends Migration {
    
     /**
   * Run the migrations.
   *
   * @return void
   */
   public function up() {
      
      if ( !Schema::hasTable('tbproduto') ) {
         Schema::create('tbproduto', function (Blueprint $table) {
            $table->increments('id_produto' );
            $table->string('codigo',    50  );            
            $table->string('descricao', 100 );            
            $table->integer('quantidade'   )->nullable();
            $table->decimal('preco',10,2 )->nullable();  
            $table->integer('id_fornecedor');
            $table->timestamps();
            
            $table->foreign('id_fornecedor','fk_tbproduto_tbornecedor_id_fornecedor')
                                 ->references('id_fornecedor')
                                 ->on('tbfornecedor');


         });

      } else {

      }

   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down() {
     Schema::drop('tbproduto');
   }
   
}
