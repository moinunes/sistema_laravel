<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbfornecedorTable extends Migration {
    

     /**
   * Run the migrations.
   *
   * @return void
   */
   public function up() {
      
      if ( !Schema::hasTable('tbfornecedor') ) {
         Schema::create('tbfornecedor', function (Blueprint $table) {
            $table->increments('id_fornecedor');
            $table->string('codigo', 20 )->nullable();
            $table->string('nome', 100  )->nullable();
            $table->timestamps();
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
     Schema::drop('tbfornecedor');
   }
   
}
