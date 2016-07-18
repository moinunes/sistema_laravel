<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Input;

class ContatoController extends Controller {

   /**
   * Mostra o formulário de contato
   */
   public function getIndex() {
      $data =  new \stdClass();
      $data->nome  = '';
      $data->email = '';
      return view('contato.index')->with( 'data', (object)$data );
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
   public function regras() {
      return [
        'nome' => 'required|max:255',
        'email' => 'required',
        'message' => 'required',
      ];
   }

   public function postIndex( Request $request) {
      $data  = $request->all();
      $rules = $this->regras();
      $validator = Validator::make( Input::all(), $rules );
      if ( $validator->fails() ) {        
        return view( 'contato.index' )->withErrors( $validator )
                                      ->with( 'data', (object)$data );
      }

   }


}
