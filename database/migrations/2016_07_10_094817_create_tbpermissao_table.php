<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbpermissaoTable extends Migration {
    
     /**
   * Run the migrations.
   *
   * @return void
   */
   public function up() {
      
      if ( !Schema::hasTable('tbpermissao') ) {
         Schema::create('tbpermissao', function (Blueprint $table) {
            $table->increments('id_permissao');
            $table->integer('id_grupo'  )->nullable();           
            $table->integer('id_menu'   )->nullable();            
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
     //Schema::drop('tbpermissao');
   }
   
}
