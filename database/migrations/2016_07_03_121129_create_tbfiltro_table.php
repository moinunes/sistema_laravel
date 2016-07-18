<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbfiltroTable extends Migration {

   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up() {
      
      if ( !Schema::hasTable('tbfiltro') ) {
         Schema::create('tbfiltro', function (Blueprint $table) {
            $table->increments('id');
            $table->string('inputs',     100 )->nullable();            
            $table->string('ordem',      20  )->nullable();
            $table->string('controller', 100 )->nullable();
            $table->integer('page'   )->nullable();
            $table->integer('id_user')->nullable();  
            $table->string('manter_filtro',1)->nullable();
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
     Schema::drop('tbfiltro');
   }

}
