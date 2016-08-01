<?php

/******************************************************************************************************
*
* View.....: fornecedor_form
* Descrição: Cadastro de Fornecedor
* Objetivo.: Exibir Formulário para: incluir, alterar, excluir, consultar e imprimir
*
******************************************************************************************************/

use App\Core\Infra\Infra_Html;
use App\Core\Infra\Infra_View;

$titulo = 'Cadastro de Fornecedor';
?>

@extends('layouts.layout_sistema')
@section('content')

<?=Infra_Html::exibir_titulo_form( $titulo, $data->acao ) ?>

<form action="{{url('fornecedor/confirmar')}}" method="post"  role="form">
   
   <div class="div_form">
      <?=Infra_Html::exibir_string_campos_obrigatorios() ?>

      <!-- input hidden -->
      <?= Infra_Html::input_hidden( '_token',        csrf_token()         ); ?>
      <?= Infra_Html::input_hidden( 'acao',          $data->acao          ); ?>
      <?= Infra_Html::input_hidden( 'readonly',      $data->readonly      ); ?>
      <?= Infra_Html::input_hidden( 'id_fornecedor', $data->id_fornecedor ); ?>

      <!--  desenhar interface -->
      <!-- -->              
      <table border="0" width="100%">
         <tr class='obrigatorio'>
            <td width="15%">Código*</td>
            <td width="85%">Nome*</td>
         </tr>
         <tr>
            <td><?= Infra_Html::input_text( 'codigo_fornecedor', $data->codigo_fornecedor, 10, 10, $data->readonly ); ?></td>
            <td><?= Infra_Html::input_text( 'nome_fornecedor',  $data->nome_fornecedor,   60, 60, $data->readonly ); ?></td>
         </tr>               
      </table> 
   </div>

   @include('layouts.exibir_botoes')
   @include('layouts.exibir_erros')
   
</form>   

@endsection
