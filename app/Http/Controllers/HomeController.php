<?php


namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use input;
use auth;

class HomeController extends Controller {

   /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct() {
      $this->middleware('auth');
   }

   /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
   public function index() {
      return view('home.home');
   }

   public function exibir_permissao_negada( $param1 = null) {      
      $data = new \stdClass();     
      $data->usuario = Auth::user()->name;
      $data->rota    = $param1;
      return view( 'home.exibir_erros' )->with('data',$data );      
   }

}
