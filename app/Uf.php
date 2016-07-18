<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;


class Uf extends Model {

   protected $table = 'tbuf';
   protected $primaryKey = 'id_uf';

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [ 'id_uf', 'sigla_uf', 'nome_uf', ];


}

