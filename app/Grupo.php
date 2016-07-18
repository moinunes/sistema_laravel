<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;


class Grupo extends Model {


   protected $table = 'tbgrupo';
   protected $primaryKey = 'id_grupo';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'id_grupo','grupo','descricao' ];

   
}

