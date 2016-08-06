<?php

/******************************************************************************************************
*
* View.....: user_grid 
* Descrição: Cadastro de Usuários
* Objetivo.: Montar Formulário de pesquisa e exibir registros na grid
*
******************************************************************************************************/

use App\Core\Infra\Infra_Html;

$titulo = 'Cadastro - Usuários';

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
            <td width="25%">Nome</td>
            <td width="25%">Usuário</td>
            <td width="25%">Email</td>
            <td width="50%"></td>
         </tr> 
         <tr>
           <td><input  type='text' name="filtro_nome"    value="{{$filtros->filtro_nome}}"    size="25" maxlength="25" ></td>
           <td><input  type='text' name="filtro_usuario" value="{{$filtros->filtro_usuario}}" size="25" maxlength="25" ></td>
           <td><input  type='text' name="filtro_email"   value="{{$filtros->filtro_email}}"   size="25" maxlength="25" ></td>                  
           <td><button type="submit" class="btn btn-success btn_filtrar">Filtrar</button></td>
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
         <td width='30%'><?php Infra_Html::criar_titulo_grid( 'Nome completo', 'nome' );?></td>
         <td width='30%'><?php Infra_Html::criar_titulo_grid( 'Usuário',       'usuario' );?></td>
         <td width='60%'><?php Infra_Html::criar_titulo_grid( 'Email',         'email' );?></td>                     
      </tr>
      @foreach ( $data as $item )                   
         <tr>
            <td>
               <?php
               Infra_Html::criar_link_com_permissao( 'consultar', $item->id );
               Infra_Html::criar_link_com_permissao( 'alterar',   $item->id );
               Infra_Html::criar_link_com_permissao( 'excluir',   $item->id );
               ?>
            </td>              
            <td>{{$item->nome}}</td>
            <td>{{$item->usuario}}</td>
            <td>{{$item->email}}</td>                
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