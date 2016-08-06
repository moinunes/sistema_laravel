<?php

/******************************************************************************************************
*
* View.....: login
* Objetivo.: acessar o sistema
*
******************************************************************************************************/

use App\Core\Infra\Infra_Html;
use App\Core\Infra\Infra_View;

?>

@extends('layouts.app')
@section('content')

<div class="div_titulo">Login</div>    
        
<form name='frmLogin' class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
   <div class="div_form">
      {!! csrf_field() !!}    
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <table width="100%" border="0">
         <tr>
            <td width="60%"></td>
            <td width="20%"><input type="radio" name="login_por" value="usuario" {{$data->checked_usuario}} onclick='alterar()' >Usuário</td>
            <td width="20%"><input type="radio" name="login_por" value="email"   {{$data->checked_email}}   onclick='alterar()'>Email</td>
         </tr>
         <tr>
            <td height="10" colspan="3"></td>
         </tr>
         <tr>
            <td colspan="3"><label id="label_usuario_email" for="male">Usuário</label></td>
         </tr>
         <tr>
            <td colspan="3">
               <div id='div_usuario'><input type="text" name="usuario" value="{{ old('usuario') }}" size='40' ></div>
               <div id='div_email'><input type="text" name="email" value="{{ old('usuario') }}" size='40' ></div>
            </td>
         </tr>
         <tr>
            <td colspan="3">Senha</td>
         </tr>
         <tr>
            <td colspan="3">
               <input type="password" name="senha" size='40'>
            </td>
         </tr>
      </table>      
   </div>

   <div class="div_rodape">
      <table width="100%" border="0" class="cor_form">
         <tr>
            <td width="50%"></td>
            <td width="50%" align="right">
               <button type="submit"  class="pull-right btn_confirmar">Entrar</button>
            </td>
         </tr>
      </table>
   </div>

   <div class="alerta">
      <?php
      if(isset($data)){
         print $data->erro;
      }
      

      ?>
   </div>

   <script type="text/javascript">
      
      $( document ).ready(function() {
        alterar();
      });

      function alterar() {
         var modo = $( "input:checked" ).val();         
         texto = (modo =='usuario') ? 'Usuário': 'Email';
         $("#label_usuario_email").text( texto );
         if ( modo=='usuario') { 
            $("#div_usuario").show();
            $("#div_email").hide();
         } else {
            $("#div_usuario").hide();
            $("#div_email").show();
         }
      }      

   </script>

</form>

@include('layouts.exibir_erros') 

@endsection


