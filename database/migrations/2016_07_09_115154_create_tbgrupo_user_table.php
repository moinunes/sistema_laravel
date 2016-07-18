<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbgrupouserTable extends Migration {
    
     /**
   * Run the migrations.
   *
   * @return void
   */
   public function up() {
      
      if ( !Schema::hasTable('tbgrupo_user') ) {
         Schema::create('tbgrupo_user', function (Blueprint $table) {
            $table->increments('id_grupo_user');
            $table->integer('id_grupo'  )->nullable();           
            $table->integer('id_user'   )->nullable();            
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
     //Schema::drop('tbgrupo_user');
   }
   
}
