<?php

/******************************************************************************************************
*
* View.....: fornecedor_grid 
* Descrição: Cadastro de fornecedor
* Objetivo.: Montar Formulário de pesquisa e exibir registros na grid
*
******************************************************************************************************/

use App\Core\Infra\Infra_Html;

$titulo = 'Cadastro - Fornecedor';

?>

@extends('layouts.layout_sistema')
@section('content')

<div class="div_titulo">{{$titulo}}</div>
         
<!-- monta os filtros para pesquisa -->
<!--  -->
<div class="div_filtro">

   <?= Infra_Html::Form( 'formulario' ); ?>

      <?= Infra_Html::input_hidden( '_token',  csrf_token() ); ?>

      <table class="table-responsive" width="100%" border="0">
         <tr>
            <td width="10%">Código</td>
            <td width="27%">Nome</td>
            <td width="63%"></td>
         </tr> 
         <tr>
           <td><?= Infra_Html::input_text( 'filtro_codigo_fornecedor', $filtros->filtro_codigo_fornecedor, 10, 10 ); ?></td>
           <td><?= Infra_Html::input_text( 'filtro_nome_fornecedor',   $filtros->filtro_nome_fornecedor,   30, 30 ); ?></td>                    
           <td><?= Infra_Html::input_submit( 'Filtrar', 'btn_filtrar' ); ?></td>                    
         </tr>
      </table>

   </form>

</div>

<!-- monta o grid -->
<!--  -->
<div class="div_grid">
   <table class="table table-condensed table-bordered table-hover">            
      <tr class="cor_azul2">
         <td width='10%'>
            <?php Infra_Html::criar_link_com_permissao( 'incluir'  );?>
            <?php Infra_Html::criar_link_com_permissao( 'imprimir' );?>
         </td>               
         <td width='10%'><?php Infra_Html::criar_titulo_grid( 'Código', 'codigo_fornecedor' );?></td>
         <td width='80%'><?php Infra_Html::criar_titulo_grid( 'Nome',   'nome_fornecedor' );?></td>
      </tr>
      @foreach ( $data as $item )
         <tr>
            <td>
               <?php
               Infra_Html::criar_link_com_permissao( 'consultar', $item->id_fornecedor );
               Infra_Html::criar_link_com_permissao( 'alterar',   $item->id_fornecedor );
               Infra_Html::criar_link_com_permissao( 'excluir',   $item->id_fornecedor );
               ?>
            </td>
            <td>{{$item->codigo_fornecedor}}</td>
            <td>{{$item->nome_fornecedor}}</td>
         </tr>
      @endforeach               
   </table>
</div>    

<!-- monta o paginador -->
<!--  -->
<div class="div_paginator">        
   {!! $data->links() !!}
</div>
      

@endsection