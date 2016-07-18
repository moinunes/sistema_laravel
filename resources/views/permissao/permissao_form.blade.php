<?php
/**************************************************************************
*
* View.....: permissao_form 
* Descrição: Cadastro de permissão dos grupos
*
* Objetivo.: Exibir Formulário para: cadastrar permissões dos grupos de usuários
*
***************************************************************************/

use App\Core\Infra\Infra_Permissao;
$titulo   = 'Permissões';

?>

@extends('layouts.layout_sistema')

@section('content')

<div class="row" >
   <div class="col-md-10 col-md-offset-1" >
      
      <!-- título -->   
      <div class="div_titulo">{{$titulo}}</div>
      <div class="div_form">
         
      <form id='frm_permissao' action="{{url('permissao/confirmar')}}" method="post" onSubmit="return validar_submit();" >

         <table border="0" width="100%">
            <tr>
               <td width="5%"></td>    
               <td width="5%">Grupo:</td>    
               <td width="90%" class='obrigatorio'>{{$data->grupo}}</td>    
            </tr> 
            
         </table> 
            
         <!-- inputs hidden -->
         <input type="hidden" name="_token"   value="{{ csrf_token() }}">
         <input type="hidden" name="acao"     value="{{$data->acao}}">
         <input type="hidden" name="id_grupo" id="id_grupo" value="{{$data->id_grupo}}">  

           
         <div id='jstree' style="margin:5px" class="div_grid">

            <ul>
               <?php
               $permissao = new infra_Permissao();
               $permissao->obter_menus_superior( $menus_superior, $data->id_grupo  );
               ?>
               @foreach ( $menus_superior as $superior )
                  <li id="txtPermissao_{{$superior->id_menu}}" >{{$superior->titulo}}
                     <?php $permissao->obter_menus_itens( $menus_itens, $superior->id_menu, $data->id_grupo);?>
                     @foreach ( $menus_itens as $itens )
                         <ul>
                           <li id="txtPermissao_{{$itens->id_menu}}" >{{$itens->titulo}}
                              <ul>
                                 <?php
                                 $permissao->obter_menus_itens( $sub_itens, $itens->id_menu, $data->id_grupo );
                                 ?>
                                 @foreach ( $sub_itens as $sub )
                                    <?php Infra_Permissao::obter_permissao( $resultado, $data->id_grupo, $sub->id_menu); ?>                      
                                    <li id="txtPermissao_{{$sub->id_menu}}" data-checked="{{$resultado}}">{{$sub->titulo}}
                                 @endforeach     
                              </ul>
                           </li>
                        </ul>
                     @endforeach
                  </li>  
               @endforeach
            </ul>           

         </div>

         @include('layouts.exibir_botoes')
      </form>

   </div>
</div>

<script type="text/javascript">

   $(document).ready(function () {

      $('#jstree').jstree({          
         "plugins" : [  "checkbox" ],
          core: { "themes": { "icons": false }}
      });      
      $('#jstree').jstree(true).open_all();
      
      marcar();
      
   });

   function marcar() {
      var itens = $( "li" );
      $.each( itens, function () {
         if( $(this).attr('data-checked') == '1' ) {
            $('#jstree').jstree(true).select_node( this.id ); // seleciona item
         }
      });
   }

   function validar_submit() {
      criar_inputs();
      return true
   }

   function criar_inputs() {
      itens = $('#jstree').jstree(true).get_selected();  
      var input   =  document.createElement("input");
      input.type  = "text";
      input.id    = 'txt_campos';
      input.name  = 'txt_campos';
      input.value = itens;   
      frm_permissao.appendChild(input);        
   }

</script>



@endsection