<?php 
namespace App\Http\Middleware;

use Closure;

use App\Core\Infra\Infra_Permissao;
use Request;

use Auth;


class PermissaoMiddleware {
   /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
   public function handle( $request, Closure $next, $guard = null )  { 

      if ( Auth::guard($guard)->check() ) {
         if ( !Infra_Permissao::tem_permissao() ) {
            
            //$data = array();
            $rota = Request::segment(1); 
            //dd($rota);
            //return redirect( 'permissao/negada' );
            return redirect()->action('PermissaoController@negada', ['rota' => $rota]  );
            //return redirect('permissao/negada')->with( 'teste', 'Login Failed');
         } 
      }

      return $next($request);
   }

}