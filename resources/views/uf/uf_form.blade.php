<?php
/**************************************************************************************
*
* View.....: uf_exibir_form
* Descrição: Cadastro de UF
* Objetivo.: Exibir Formulário para: incluir, alterar, excluir, consultar e imprimir
*
***************************************************************************************/

use App\Core\Infra\Infra_Html; // provisório :  por o apelido no /var/www/laravel5/config/app.php:
use App\Core\Hlp\Hlp_View;

$titulo = 'Cadastro de UF';

//dd($data);
?>

@extends('layouts.layout_sistema')

@section('content')
<div class="row">
   <div class="col-md-10 col-md-offset-1">
      
      <!-- título -->
      <div class="div_titulo">{{hlp_view::obter_titulo($data->acao)}} - {{$titulo}}</div>
         

      <form action="{{url('uf/confirmar')}}" method="post"  role="form">
      
         <div class="div_form">  
            <!-- inputs hidden -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="acao"   value="{{$data->acao}}">
            <input type="hidden" name="id_uf"  value="{{$data->id_uf}}">
            <input type="hidden" id="readonly"   name="readonly"   value="{{$data->readonly}}" >

            <table border="0" width="100%">
               <tr><td align="right" colspan="2">* campos obrigatórios</td></tr>            
               
               <!--  
                  desenhar interface
               -->
               <tr class='obrigatorio'>
                  <td width="15%">Sigla*</td>
                  <td width="85%">Nome*</td>
               </tr>
               <tr>
                  <td><input  type='text' name="sigla_uf" value="{{$data->sigla_uf}}" size="3"  maxlength="2"  {{$data->readonly}} ></td>
                  <td><input  type='text' name="nome_uf"  value="{{$data->nome_uf}}"  size="60" maxlength="60" {{$data->readonly}} ></td>
               </tr>               
            </table> 
         </div>

         @include('layouts.exibir_botoes')
         @include('layouts.exibir_erros')
         
      </form>   

   </div>
</div>
@endsection
