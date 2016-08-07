<?php

/******************************************************************************************************
*
* View.....: produto_form
* Descrição: Cadastro de produto
* Objetivo.: Exibir Formulário para: incluir, alterar, excluir, consultar e imprimir
*
******************************************************************************************************/

use App\Core\Infra\Infra_Html;
use App\Core\Infra\Infra_View;

$titulo = 'Cadastro de Produto';

Infra_Html::set_errors( $errors );

//print_r($data);die();
?>

@extends('layouts.layout_sistema')
@section('content')

<?=Infra_Html::exibir_titulo_form( $titulo, $data->acao ) ?>

<form action="{{url('produto/confirmar')}}" method="post"  role="form" >

   <div class="div_form">
      <?=Infra_Html::exibir_string_campos_obrigatorios() ?>

      <!-- input hidden -->
      <?= Infra_Html::input_hidden( '_token',     csrf_token()      ); ?>
      <?= Infra_Html::input_hidden( 'acao',       $data->acao       ); ?>
      <?= Infra_Html::input_hidden( 'readonly',   $data->readonly   ); ?>
      <?= Infra_Html::input_hidden( 'id_produto', $data->id_produto ); ?>

      <div id="div_buscar" name="div_buscar" title="Buscar"></div>
      
      <!--  desenhar interface -->
      <!-- -->       
      <table border="0" width="100%">
         <tr>
            <td colspan="2">
               <fieldset class="fsStyle" style="width:45%">
                  <legend class="legendStyle {{Infra_Html::obrigatorio('id_fornecedor')}}" >Fornecedor*</legend>
                  <table border="0" width="100%">
                     <tr >
                        <td width="30%" >Código</td>
                        <td width="65%">Descrição<td>
                        <td width="5%"></td>
                     </tr>
                     <tr>
                        <td>
                           <input  type='hidden' id="id_fornecedor"     name="id_fornecedor"     value="{{$data->id_fornecedor}}"     size="8"  maxlength="10" readonly='$data->readonly' >
                           <input  type='text'   id="fornecedor_codigo" name="fornecedor_codigo" value="{{$data->fornecedor_codigo}}" size="8"  maxlength="10" readonly='$data->readonly' >
                        </td>
                        <td><input type='text'   id="fornecedor_nome" name="fornecedor_nome" value="{{$data->fornecedor_nome}}" size="40" maxlength="40" readonly='$data->readonly' ></td>
                        <td>
                           <input type="button" onclick="buscar_fornecedor()" value=">>" />
                        </td>
                     </tr>               
                  </table>
               </fieldset>
            </td>
         </tr>

         <tr class='obrigatorio'>
            <td width="15%" class="{{Infra_Html::obrigatorio('codigo')}}" >Código*   </td>
            <td width="85%" class="{{Infra_Html::obrigatorio('descricao')}}"   >Descrição*</td>
         </tr>         
         <tr>
            <td><input  type='text' id="codigo" name="codigo" value="{{$data->codigo}}" size="8"  maxlength="10" {{$data->readonly}}></td>
            <td><input  type='text' id="descricao"   name="descricao"   value="{{$data->descricao}}" size="60"  maxlength="60" {{$data->readonly}}></td>           
         </tr>

         <tr class='padrao'>
            <td width="15%">Quantidade</td>
            <td width="85%" class="{{Infra_Html::obrigatorio('descricao')}}">Preço</td>
         </tr>         
         <tr>
            <td><input  type='text' id="quantidade" name="quantidade" value="{{$data->quantidade}}" size="12"  maxlength="12" {{$data->readonly}}></td>
            <td><input  type='text' id="preco"      name="preco"      value="{{$data->preco}}"      size="12"  maxlength="12" {{$data->readonly}}></td>            
         </tr>

      </table> 
         
   </div>

   @include('layouts.exibir_botoes')
   @include('layouts.exibir_erros')
         
</form>

@endsection