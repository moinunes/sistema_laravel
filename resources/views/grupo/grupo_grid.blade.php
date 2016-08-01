<?php

/******************************************************************************************************
*
* View.....: grupo_grid 
* Descrição: Cadastro de grupo
* Objetivo.: Montar Formulário de pesquisa e exibir registros na grid
*
******************************************************************************************************/

use App\Core\Infra\Infra_Html;

$titulo = 'Cadastro - Grupo';

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
            <td width="10%">Grupo</td>
            <td width="35%">Descrição</td>
            <td width="55%"></td>
         </tr> 
         <tr>
           <td><input  type='text' name="filtro_grupo"     value="{{$filtros->filtro_grupo}}"     size="8"   maxlength="10" ></td>
           <td><input  type='text' name="filtro_descricao" value="{{$filtros->filtro_descricao}}" size="40"  maxlength="50" ></td>
           <td><button type="submit" class="btn btn-success btn_filtrar">Filtrar</button></td>                  
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
         <td width='10%'><?php Infra_Html::criar_titulo_grid( 'Grupo',     'grupo'     );?></td>
         <td width='80%'><?php Infra_Html::criar_titulo_grid( 'Descrição', 'descricao' );?></td>
      </tr>
      @foreach ( $data as $item )
         <tr>
            <td>
               <?php
               Infra_Html::criar_link_com_permissao( 'consultar', $item->id_grupo );
               Infra_Html::criar_link_com_permissao( 'alterar',   $item->id_grupo );
               Infra_Html::criar_link_com_permissao( 'excluir',   $item->id_grupo );
               ?>
            </td>
            <td>{{$item->grupo}}</td>
            <td>{{$item->descricao}}</td>
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