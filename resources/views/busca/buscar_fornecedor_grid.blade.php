<?php

/**************************************************************************
*
* View.....: busca_grid 
* 
* Objetivo.: Montar Formulário de pesquisa e exibir registros na grid
*
***************************************************************************/
$titulo = 'Buscar Fornecedor';
?>
@extends('layouts.layout_busca')
@section('content')
<body>            
         <div class="div_titulo">{{$titulo}}</div>
         
         <!-- monta os filtros para pesquisa -->         
         <div class="div_filtro">
               <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
               <table class="table-responsive" width="100%" border="0">
                  <tr>
                     <td width="25%">Código</td>
                     <td width="65%">Descrição</td>
                     <td width="10%"></td>
                  </tr> 
                  <tr>
                    <td><input type='text'   id="filtro_codigo_fornecedor" name="filtro_codigo_fornecedor" value="{{$filtros->filtro_codigo_fornecedor}}" size="8"  maxlength="10" ></td>
                    <td><input type='text'   id="filtro_nome_fornecedor"   name="filtro_nome_fornecedor"   value="{{$filtros->filtro_nome_fornecedor}}"   size="30" maxlength="30" ></td>
                    <td><input type="button" id="btn_filtrar"      name="btn_filtrar"      onclick="buscar_fornecedor()" value="Filtrar" class="btn btn-success btn_filtrar"  ></td>
                  </tr>
               </table>
            
         </div>

         <div class="div_busca_titulo" >      
            <table class="table table-condensed">
               <tr class="cor_azul2">
                  <th width='10%'></th>                      
                  <th width='20%'><input type="button" onclick="buscar_fornecedor('codigo_fornecedor')" value="Código"    class="btn_buscar_titulo"></th>
                  <th width='70%'><input type="button" onclick="buscar_fornecedor('nome_fornecedor'  )" value="Descricao" class="btn_buscar_titulo"></th>
               </tr>               
            </table>
         </div>

         <div class="div_busca_grid" id="div_grid">
            <table class="table table-condensed table-bordered table-hover">
               <tbody>                  
                  @foreach ( $data as $item )
                     <tr>
                        <td width='10%'><button type="button" class="btn_fornecedor btn_buscar" data-id="{{$item->id_fornecedor}}" data-codigo="{{$item->codigo_fornecedor}}" data-descricao="{{$item->nome_fornecedor}}">ok</button></td>
                        <td width='20%'>{{$item->codigo_fornecedor}}</td>
                        <td width='70%'>{{$item->nome_fornecedor}}</td>                
                     </tr>
                  @endforeach                  
               </tbody>
            </table>
      </div>    

      
      </body>
    


@endsection