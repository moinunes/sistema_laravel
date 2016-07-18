<?php

/**************************************************************************
*
* View.....: permissao_grid 
* Descrição: Cadastro de permissões
* Objetivo.: Montar Formulário de pesquisa e exibir registros na grid
*
***************************************************************************/

use App\Core\Infra\Infra_Html; // provisório :  por o apelido no /var/www/laravel5/config/app.php:

$titulo = 'Cadastro - Permissões';

?>

@extends('layouts.layout_sistema')
@section('content')

<?php
//dd($titulo);
?>

<div class="row">  
   <div class="col-md-10 col-md-offset-1">
      <div class="div_titulo">{{$titulo}}</div>
         
      <!-- monta os filtros para pesquisa -->
      <div class="div_filtro">
         
         <form action="{{url('permissao')}}" method="post" class="col-sm-12 form-horizontal" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table-responsive" width="40%" border="0">
               <tr>
                  <td width="25%">Grupo</td>
                  <td width="75%"></td>
               </tr> 
               <tr>
                 <td><input  type='text' name="filtro_grupo" value="{{$filtros->filtro_grupo}}"         size="10" maxlength="10" ></td>
                 <td><input  type='text' name="filtro_descricao" value="{{$filtros->filtro_descricao}}" size="30" maxlength="30" ></td>
                 <td><button type="submit" class="btn_filtrar">Filtrar</button></td>
               </tr>
            </table>
         </form>
      </div>

      <!-- exibe a grid da pesquisa -->
      <div class="div_grid">  
         <table class="table table-condensed table-bordered table-hover">
           <thead>
               <tr class="cor_azul2">
                   <th width='10%' align='center'>
                     <!-- exibe os links [imprimir] -->                  
                     <a href='/permissao/imprimir'><span class='btn glyphicon glyphicon-print'></span></a>
                   </th>                
                   <th width='20%'><a href="/permissao/?order=grupo">Grupo</a></th>
                   <th width='70%'><a href="/permissao/?order=descricao">Descrição</a></th>
               </tr>
           </thead>

           <tbody>
               @foreach ( $data as $item )                   
                 <tr>
                   <td>
                     <!-- exibe os links [consultar,alterar,excluir] -->
                     <?php
                     Infra_Html::criar_link_com_permissao( 'alterar',   $item->id_grupo );
                     ?>
                   </td>              
                   <td>{{ $item->grupo }}</td>    
                   <td>{{ $item->descricao }}</td>               
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