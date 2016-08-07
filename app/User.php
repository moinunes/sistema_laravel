<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Crypt;

class User extends Authenticatable {

   protected $table      = 'tbusuario';
   protected $primaryKey = 'id_usuario';
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email','usuario', 'password', 'master'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   public function obter_usuario( &$resultado, $nome_campo, $valor  ) {      
      $resultado = User::where( $nome_campo, '=', $valor )->first();
   }
    
}
