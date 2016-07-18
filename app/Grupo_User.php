<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo_User extends Model {

	protected $table      = 'tbgrupo_user';
   protected $primaryKey = 'id_grupo_user';
   
   protected $fillable=[ 'id_grupo', 'id_user'  ];

}
