<?php

/**************************************************************************
*
* View.....: produto_grid 
* Descrição: Cadastro de produtos
* Objetivo.: Montar Formulário de pesquisa e exibir registros na grid
*
***************************************************************************/

use App\Core\Infra\Infra_Html; // provisório :  por o apelido no /var/www/laravel5/config/app.php:

$titulo = 'Cadastro - Produtos';

?>

@extends('layouts.layout_sistema')
@section('content')

<div class="row">  
   <div class="col-md-10 col-md-offset-1">

         <div class="div_titulo">{{$titulo}}</div>
         
         <!-- monta os filtros para pesquisa -->         
         <div class="div_filtro">
            <form action="{{url('produto')}}" method="post" class="col-sm-12 form-horizontal" role="form">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <table class="table-responsive" width="50%" border="0">
                  <tr>
                     <td width="25%">Código</td>
                     <td width="65%">Nome</td>
                     <td width="10%"></td>
                  </tr> 
                  <tr>
                    <td><input  type='text' name="filtro_codigo_produto" value="{{$filtros->filtro_codigo_produto}}" size="10" maxlength="10" ></td>
                    <td><input  type='text' name="filtro_nome_produto"   value="{{$filtros->filtro_nome_produto}}"   size="30" maxlength="30" ></td>
                    <td><button type="submit" class="btn btn-success btn_filtrar">Filtrar</button></td>
                  </tr>
               </table>
            </form>
         </div>

         <div class="div_grid">      
            <!-- exibe a grid da pesquisa -->
            <table class="table table-condensed table-bordered table-hover">
               <thead>
                     <tr class="cor_azul2">
                        <th width='20%'  >
                        <?php
                        //Infra_Html::criar_link_com_permissao( 'incluir'  );
                        //Infra_Html::criar_link_com_permissao( 'imprimir' );
                        ?>
                        <a href='/produto/incluir'><span class='btn btn-success glyphicon glyphicon-plus'></span></a>
                        <a href='/produto/imprimir'><span class='btn glyphicon glyphicon-print'></span></a>
                        </th>                      
                        <th width='20%'><a href="/produto/?ordem=codigo_produto">Código</a></th>
                        <th width='60%'><a href="/produto/?ordem=nome_produto">Descrição</a></th>                         
                     </tr>
               </thead>

               <tbody>
                  @foreach ( $data as $item )                   
                     <tr>
                        <td>
                           <?php
                           Infra_Html::criar_link_com_permissao( 'consultar', $item->id_produto );
                           Infra_Html::criar_link_com_permissao( 'alterar',   $item->id_produto );
                           Infra_Html::criar_link_com_permissao( 'excluir',   $item->id_produto );
                           ?>
                        </td>              
                        <td>{{$item->codigo_produto}}</td>
                        <td>{{$item->nome_produto}}</td>                
                     </tr>
                  @endforeach
               </tbody>
            </table>
      </div>    

      <div class="div_paginator">        
         {!! $data->links() !!}
      </div>
      
   </div>    
</div>

@endsection