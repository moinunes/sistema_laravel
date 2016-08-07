<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatetbusuarioTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up() {
      if ( !Schema::hasTable('tbusuario') ) {         
         Schema::create('tbusuario', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->string('nome');
            $table->string('usuario')->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('master',1);
            $table->rememberToken();
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
      //Schema::drop('tbusuario');
   }

}
