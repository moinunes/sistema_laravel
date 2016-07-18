<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbufTable extends Migration {
    
     /**
   * Run the migrations.
   *
   * @return void
   */
   public function up() {
      
      if ( !Schema::hasTable('tbuf') ) {
         Schema::create('tbuf', function (Blueprint $table) {
            $table->increments('id_uf');
            $table->string('sigla_uf', 2 );            
            $table->string('nome_uf',  100   );            
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
     Schema::drop('tbuf');
   }
   
}
