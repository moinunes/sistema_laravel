<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbmenuTable extends Migration 
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up() {
      
      if ( !Schema::hasTable('tbmenu') ) {
         Schema::create('tbmenu', function (Blueprint $table) {
            $table->increments('id_menu');
            $table->string('nome',  100 )->unique();
            $table->string('titulo',100 );
            $table->string('rota',  100 )->nullable();
            $table->string('acao',  20  )->nullable();
            $table->integer('posicao');
            $table->integer('id_pai')->nullable();
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
     Schema::drop('tbmenu');
   }
   
}
