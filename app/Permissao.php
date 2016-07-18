<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model {

   protected $table = 'tbpermissao';
   protected $primaryKey = 'id_permissao';

   protected $fillable=[ 'id_grupo', 'id_menu' ];

 

}
