<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbgrupoTable extends Migration {
    
     /**
   * Run the migrations.
   *
   * @return void
   */
   public function up() {
      
      if ( !Schema::hasTable('tbgrupo') ) {
         Schema::create('tbgrupo', function (Blueprint $table) {
            $table->increments('id_grupo');
            $table->string('grupo',  50 );            
            $table->string('descricao',    100 );            
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
     //Schema::drop('tbgrupo');
   }
   
}
