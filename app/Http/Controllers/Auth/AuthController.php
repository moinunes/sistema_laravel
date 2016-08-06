<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Support\Facades\Auth;

use Input;
use Crypt;

class AuthController extends Controller {

   /*
   |--------------------------------------------------------------------------
   | Registration & Login Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles the registration of new users, as well as the
   | authentication of existing users. By default, this controller uses
   | a simple trait to add these behaviors. Why don't you explore it?
   |
   | Este controlador manipula o registro de novos usuários, bem como a
   | autenticação de usuários existentes. Por padrão, esse controlador usa
   | um traço simples de adicionar esses comportamentos. Por que não explorá-lo?
   */

   use AuthenticatesAndRegistersUsers, ThrottlesLogins;

   /**
   * Where to redirect users after login / registration.
   *
   * @var string
   */
   protected $redirectTo = '/';

   /**
   * Create a new authentication controller instance.
   *
   * @return void
   */
   public function __construct() {
      $this->middleware('guest', ['except' => 'logout']);
   }

   public function showLoginForm()  {
      $data = new \stdClass(); 
      $data->checked_usuario ='checked' ;
      $data->checked_email   ='' ;
      $data->erro  ='' ;
      return view( 'auth.login' )->with( 'data', $data  );
   }

   public function login() {      
      $tudo_ok = false;
      $campo   = Input::get('login_por');
      $valor   = $campo=='usuario' ? Input::get('usuario') : Input::get('email');
      $senha   = Input::get('senha');

      $user = new User();
      $user->obter_usuario( $resultado, $campo , $valor, $senha );
      if ( $resultado ) {         
         $password = Crypt::decrypt( $resultado->password);
         if ( $senha == $password ) {
            $tudo_ok = true;            
         }
      }
      
      if ( $tudo_ok ) {
         Auth::login($resultado);
         return redirect( 'home' );

      } else {
         $data       = new \stdClass(); 
         $data->erro = 'Dados incorretos.';
         $data->checked_usuario = $campo == 'usuario' ? 'checked' : '' ;
         $data->checked_email   = $campo == 'email'   ? 'checked' : '' ;
      }
         
      return view( 'auth.login' )->with( 'data', $data  );
      

   } // login


   /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
   protected function validator(array $data) {      
      return Validator::make($data, [
            'nome' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
      ]);
   }

   /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return User
   */
   protected function create(array $data) {
      return User::create([
         'nome' => $data['nome'],
         'email' => $data['email'],
         'password' => bcrypt($data['password']),
      ]);
   }

   
}
