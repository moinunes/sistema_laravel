<?php

/**************************************************************************
*
* View.....: uf_grid 
* Descrição: Cadastro de uf
* Objetivo.: Montar Formulário de pesquisa e exibir registros na grid
*
***************************************************************************/

use App\Core\Infra\Infra_Html; // provisório :  por o apelido no /var/www/laravel5/config/app.php:

$titulo = 'Cadastro - UF';

?>

@extends('layouts.layout_sistema')
@section('content')

<div class="row">  
   <div class="col-md-10 col-md-offset-1">

         <div class="div_titulo">{{$titulo}}</div>
         
         <!-- monta os filtros para pesquisa -->         
         <div class="div_filtro">
            <form action="{{url('uf')}}" method="post" class="col-sm-12 form-horizontal" role="form">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <table class="table-responsive" width="50%" border="0">
                  <tr>
                     <td width="25%">Sigla</td>
                     <td width="65%">Nome</td>
                     <td width="10%"></td>
                  </tr> 
                  <tr>
                    <td><input  type='text' name="filtro_sigla_uf" value="{{$filtros->filtro_sigla_uf}}" size="8"  maxlength="10" ></td>
                    <td><input  type='text' name="filtro_nome_uf"  value="{{$filtros->filtro_nome_uf}}"  size="30" maxlength="30" ></td>
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
                        Infra_Html::criar_link_com_permissao( 'incluir'  );
                        Infra_Html::criar_link_com_permissao( 'imprimir' );
                        ?>
                        
                        
                        </th>                      
                        <th width='20%'><a href="/uf/?ordem=sigla_uf">Sigla</a></th>
                        <th width='60%'><a href="/uf/?ordem=nome_uf">Nome</a></th>                         
                     </tr>
               </thead>

               <tbody>
                  @foreach ( $data as $item )                   
                     <tr>
                        <td>
                           <?php
                           Infra_Html::criar_link_com_permissao( 'consultar', $item->id_uf );
                           Infra_Html::criar_link_com_permissao( 'alterar',   $item->id_uf );
                           Infra_Html::criar_link_com_permissao( 'excluir',   $item->id_uf );
                           ?>
                        </td>              
                        <td>{{$item->sigla_uf}}</td>
                        <td>{{$item->nome_uf}}</td>                
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