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
            $rota = Request::segment(1);
            return redirect()->action('HomeController@exibir_permissao_negada', ['rota' => $rota]  );
         } 
      }
      return $next($request);
   }

}