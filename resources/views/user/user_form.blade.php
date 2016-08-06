<?php

/******************************************************************************************************
*
* View.....: user_exibir_form
* Descrição: Cadastro de Usuários
* Objetivo.: Exibir Formulário para: incluir, alterar, excluir, consultar e imprimir
*
******************************************************************************************************/

use App\Core\Infra\Infra_Html;
use App\Core\Infra\Infra_View;

$titulo = 'Cadastro de Usuários';
Infra_Html::set_errors( $errors );
?>

@extends('layouts.layout_sistema')
@section('content')

<?=Infra_Html::exibir_titulo_form( $titulo, $data->acao ) ?>

<form action="{{url('user/confirmar')}}" method="post"  role="form" >

   <div class="div_form">
      <?=Infra_Html::exibir_string_campos_obrigatorios() ?>

      <!-- input hidden -->
      <?= Infra_Html::input_hidden( '_token',   csrf_token()    ); ?>
      <?= Infra_Html::input_hidden( 'acao',     $data->acao     ); ?>
      <?= Infra_Html::input_hidden( 'readonly', $data->readonly ); ?>
      <?= Infra_Html::input_hidden( 'id',       $data->id       ); ?>

      <!--  desenhar interface -->
      <!-- -->      
      <table border="0" width="100%">
         <tr class='obrigatorio'>
            <td width="40%" class="{{Infra_Html::obrigatorio('nome')}}">Nome completo*</td>
            <td width="40%" class="{{Infra_Html::obrigatorio('usuario')}}">Usuário*</td>
            <td width="60%" class="{{Infra_Html::obrigatorio('email')}}">Email*</td>
         </tr>
         <tr>
            <td><?= Infra_Html::input_text( 'nome',  $data->nome,  50,  60,  $data->readonly ); ?></td>
            <td> <input type="text"  id="usuario" name="usuario" value="{{$data->usuario}}" size='30' maxlengt='30' x-moz-errormessage="usuario inváido" ></td>
            <td> <input type="email" id="email" name="email" value="{{$data->email}}" size='50' maxlengt='50' x-moz-errormessage="e-mail inválido" ></td>
         </tr>
         
         @if ( $data->acao == 'incluir' || $data->acao == 'alterar' )
            <tr>
               <td colspan="2">
                  <tr class='obrigatorio'>
                     <td colspan="2" class="{{Infra_Html::obrigatorio('password')}}">Senha*</td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        <?= Infra_Html::input_password( 'password', $data->password, 40,  60,  $data->readonly ); ?>
                     </td>
                  </tr>
                  <tr class='obrigatorio'>
                     <td colspan="2" class="{{Infra_Html::obrigatorio('password_confirmar')}}">Confirmar Senha*</td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        <?= Infra_Html::input_password( 'password_confirmar', $data->password_confirmar, 40,  60,  $data->readonly ); ?>
                     </td>
                  </tr>               
               </td>
            </tr>
         @endif

      </table> 

   </div>

   @include('layouts.exibir_botoes')
   @include('layouts.exibir_erros')
         
</form>

@endsection