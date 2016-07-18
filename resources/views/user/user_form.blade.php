<?php
/**************************************************************************************
*
* View.....: user_exibir_form
* Descrição: Cadastro de Usuários
* Objetivo.: Exibir Formulário para: incluir, alterar, excluir, consultar e imprimir
*
***************************************************************************************/

use App\Core\Infra\Infra_Html; // provisório :  por o apelido no /var/www/laravel5/config/app.php:
use App\Core\Hlp\Hlp_View;

$titulo = 'Cadastro de Usuários';
?>

@extends('layouts.layout_sistema')

@section('content')
<div class="row">
   <div class="col-md-10 col-md-offset-1">
      
      <!-- título -->
      <div class="div_titulo">{{hlp_view::obter_titulo($data->acao)}} - {{$titulo}}</div>
         

      <form action="{{url('user/confirmar')}}" method="post"  role="form">
      
         <div class="div_form">  
            <!-- inputs hidden -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="acao"   value="{{$data->acao}}">
            <input type="hidden" name="id"     value="{{$data->id}}">

            <table border="0" width="100%">
               <tr><td align="right" colspan="2">* campos obrigatórios</td></tr>            
               
               <!--  
                  desenhar interface
               -->
               <tr class='obrigatorio'>
                  <td width="40%">Nome*</td>
                  <td width="60%">Email*</td>
               </tr>
               <tr>
                  <td><input  type='text' name="name"  value="{{$data->name}}"  size="50" maxlength="60" ></td>
                  <td><input  type='text' name="email" value="{{$data->email}}" size="40" maxlength="60" ></td>
               </tr>

               <tr>
                  <td colspan="2">
                     <tr class='obrigatorio'>
                        <td colspan="2">Senha*</td>
                     </tr>
                     <tr>
                        <td colspan="2"><input  type='password' name="password" value="{{$data->name}}"  size="40" maxlength="60" ></td>         
                     </tr>
                     <tr class='obrigatorio'>
                        <td colspan="2">Confirmar Senha*</td>
                     </tr>
                     <tr>
                        <td colspan="2"><input  type='password' name="password_confirmation" value="{{$data->email}}" size="40" maxlength="60" ></td>
                     </tr>               
                  </td>
               </tr>

            </table> 
         </div>

         @include('layouts.exibir_botoes')
         @include('layouts.exibir_erros')
         
      </form>   

   </div>
</div>
@endsection
