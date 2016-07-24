<?php
/**************************************************************************
*
* View.....: permissao_negada
* Descrição: exibe mensagem de acesso negado
*
***************************************************************************/

use App\Core\Infra\Infra_Permissao;

$titulo   = 'Permissão';

?>

@extends('layouts.layout_sistema')
@section('content')

<div class="row">
	<div class="col-md-10 col-md-offset-1">      
   	
      <!-- título -->
    	<div class="div_titulo">
      	{{$titulo}}
    	</div>         
		
      <div class="div_form"> 
         <table width="20%">
            <tr>
               <td>Usuário:</td>
               <td>{{$data->usuario}}</td>
            </tr>
            <tr>
               <td>Acesso:</td>
               <td>{{$data->rota}}</td>
            </tr>         
            <tr>
               <td>Permissão:</td>            
               <td>Negada</td>            
            </tr>
         </table>
    	</div>

  	</div>
</div>

@endsection