@extends('layouts.app')

@section('content')

<div class="container">
   <div class="row">
      <div class="col-md-6 col-md-offset-3">          
         
         <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            <div class="div_titulo">Login</div>    
            <div class="div_form">
                  {!! csrf_field() !!}
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label class="col-md-2 control-label">E-mail</label>
                      <div class="col-md-9">
                          <input type="email"  class="form-control" name="email" value="{{ old('email') }}" >
                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label class="col-md-2 control-label">Senha</label>
                      <div class="col-md-9">
                          <input type="password" class="form-control" name="password">
                          @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>                 
            </div>

            <div class="div_rodape">
                <table width="100%" border="0" >
                  <tr>
                     <td width="50%">                         
                        <button type="submit"  class="pull-right btn_confirmar">Entrar</button>
                     </td>
                  </tr>
                  </table>                         
            </div>
            
         </form>
        
      </div>
   </div>  
</div>  

@endsection
