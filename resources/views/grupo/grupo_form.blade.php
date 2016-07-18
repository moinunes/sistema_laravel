<?php
/**************************************************************************************
*
* View.....: grupo_exibir_form
* Descrição: Cadastro de Grupo
* Objetivo.: Exibir Formulário para: incluir, alterar, excluir, consultar e imprimir
*
***************************************************************************************/
use App\Core\Infra\Infra_Html; // provisório :  por o apelido no /var/www/laravel5/config/app.php:
use App\Core\Hlp\Hlp_View;
$titulo = 'Cadastro de Grupo';


?>

@extends('layouts.layout_sistema')

@section('content')
<div class="row">
   <div class="col-md-10 col-md-offset-1">
      
      <!-- título -->
      <div class="div_titulo">{{hlp_view::obter_titulo($data->acao)}} - {{$titulo}}</div>
         

      <form action="{{url('grupo/confirmar')}}" method="post" role="form" onsubmit="validar_submit()" >
           <div class="div_form">  
            <!-- inputs hidden -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="acao"   value="{{$data->acao}}">
            <input type="hidden" name="id_grupo" id="id_grupo"    value="{{$data->id_grupo}}">
            <input type="hidden" name="txt_usuarios_selecionados" id="txt_usuarios_selecionados" >
            <input type="hidden" name="txt_usuarios_disponiveis"  id="txt_usuarios_disponiveis" >

            <table border="0" width="100%">
               <tr><td align="right" colspan="2">* campos obrigatórios</td></tr>               
               <!-- desenhar interface -->
               <tr class='obrigatorio'>
                  <td width="15%">Grupo*</td>
                  <td width="85%">Descrição*</td>
               </tr>
               <tr>
                  <td><input  type='text' name="grupo"     value="{{$data->grupo}}"     size="8"  maxlength="6" ></td>
                  <td><input  type='text' name="descricao" value="{{$data->descricao}}" size="60" maxlength="60" ></td>
               </tr>               
            </table> 

            
            <table border="0" width="100%">
               <tr height="20">
                  <td colspan="3"></td>
               </tr>
               <tr>
                  <td width="30%">Usuários disponíveis</td>
                  <td width="5%"></td>
                  <td width="70%">Usuários selecionados</td>
               </tr>
               <tr>
                  <td>
                     <select id="usuarios_disponiveis" name="usuarios_disponiveis"  size=10 multiple="multiple" style="width:290px">
                        @foreach ( $usuarios_disponiveis AS $item )
                           <option value="{{$item->id}}"><?= $item->name;?></option>
                        @endforeach                        
                     </select>
                  </td>
                  <td>
                     <a href='#'><span id="adicionar" class='btn glyphicon glyphicon glyphicon-chevron-right'></span></a>
                     <a href='#'><span id="remover"   class='btn glyphicon glyphicon glyphicon-chevron-left'></span></a>
                  </td>
                  <td>
                     <select id="usuarios_selecionados" name="usuarios_selecionados[]"  size=10 multiple="multiple" style="width:290px">
                        @foreach ( $usuarios_selecionados AS $item ) 
                           <option  value="{{$item->id}}"><?= $item->name;?></option>
                        @endforeach                        
                     </select>
                  </td>
               </tr>               
            </table> 
         </div>

         @include('layouts.exibir_botoes')
         @include('layouts.exibir_erros')


         <script type="text/javascript">

            $( "#adicionar" ).click(function() {
               adicionar();
            });

            $( "#remover" ).click(function() {
               remover();
            });

            function adicionar () {
               var value = "";
               var texto = "";
               $( "#usuarios_disponiveis option:selected" ).each( function() {
                  value = $( this ).val();
                  texto = $( this ).text();
                  // adiciona em: usuarios_selecionados
                  var option = new Option( texto, value );
                  $('#usuarios_selecionados').append(option);
                  // remove de: usuarios_disponiveis
                  $('#usuarios_disponiveis option:selected').remove();
               });
            } // adicionar

            function remover () {
               var value = "";
               var texto = "";
               $( "#usuarios_selecionados option:selected" ).each( function() {
                  value = $( this ).val();
                  texto  = $( this ).text();
                  // adiciona em: usuarios_disponiveis
                  var option = new Option( texto, value );
                  $('#usuarios_disponiveis').append(option);
                  // remove de: usuarios_selecionados
                  $('#usuarios_selecionados option:selected').remove();                 
               });
            } // remover

            function validar_submit() {
               atualizar_txt_usuarios_selecionados();
               atualizar_txt_usuarios_disponiveis();
               return true;
            }

            function atualizar_txt_usuarios_selecionados() {
               var value = "";
               var texto = "";
               var str = "";
               $( "#usuarios_selecionados option" ).each( function() {
                  value = $( this ).val();
                  texto = $( this ).text();
                  str += value+',';
               });
               $('#txt_usuarios_selecionados').val( str );
            }

            function atualizar_txt_usuarios_disponiveis() {
               var value = "";
               var texto = "";
               var str = "";
               $( "#usuarios_disponiveis option" ).each( function() {
                  value = $( this ).val();
                  texto = $( this ).text();
                  str += value+',';
               });
               $('#txt_usuarios_disponiveis').val( str );
            }

         </script>

        
      </form>   
   </div>
</div>
@endsection
   


