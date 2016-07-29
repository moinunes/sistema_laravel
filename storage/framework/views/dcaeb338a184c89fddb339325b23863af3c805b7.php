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



<?php $__env->startSection('content'); ?>

<div class="row" >
   <div class="col-md-10 col-md-offset-1" >
      
      <!-- título -->   
      <div class="div_titulo"><?php echo e($titulo); ?></div>
      <div class="div_form">
         
      <form id='frm_permissao' action="<?php echo e(url('permissao/confirmar')); ?>" method="post" onSubmit="return validar_submit();" >

         <table border="0" width="100%">
            <tr>
               <td width="5%"></td>    
               <td width="5%">Grupo:</td>    
               <td width="90%" class='obrigatorio'><?php echo e($data->grupo); ?></td>    
            </tr> 
            
         </table> 
            
         <!-- inputs hidden -->
         <input type="hidden" name="_token"   value="<?php echo e(csrf_token()); ?>">
         <input type="hidden" name="acao"     value="<?php echo e($data->acao); ?>">
         <input type="hidden" name="id_grupo" id="id_grupo" value="<?php echo e($data->id_grupo); ?>">  

           
         <div id='jstree' style="margin:5px" class="div_grid">

            <ul>
               <?php
               $permissao = new infra_Permissao();
               $permissao->obter_menus_superior( $menus_superior, $data->id_grupo  );
               ?>
               <?php foreach( $menus_superior as $superior ): ?>
                  <li id="txtPermissao_<?php echo e($superior->id_menu); ?>" ><?php echo e($superior->titulo); ?>

                     <?php $permissao->obter_menus_filhos( $menus_itens, $superior->id_menu, $data->id_grupo);?>
                     <?php foreach( $menus_itens as $itens ): ?>
                         <ul>
                           <li id="txtPermissao_<?php echo e($itens->id_menu); ?>" ><?php echo e($itens->titulo); ?>

                              <ul>
                                 <?php
                                 $permissao->obter_menus_filhos( $sub_itens, $itens->id_menu, $data->id_grupo );
                                 ?>
                                 <?php foreach( $sub_itens as $sub ): ?>
                                    <?php Infra_Permissao::obter_permissao( $resultado, $data->id_grupo, $sub->id_menu); ?>                      
                                    <li id="txtPermissao_<?php echo e($sub->id_menu); ?>" data-checked="<?php echo e($resultado); ?>"><?php echo e($sub->titulo); ?>

                                 <?php endforeach; ?>     
                              </ul>
                           </li>
                        </ul>
                     <?php endforeach; ?>
                  </li>  
               <?php endforeach; ?>
            </ul>           

         </div>

         <?php echo $__env->make('layouts.exibir_botoes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
      var _obj = $('#jstree').jstree(true).get_selected('full',true);
      selecionados_pais   = [];
      selecionados_filhos = [];
      $.each( _obj, function( key, item ) {
        selecionados_pais.push(item.parents);
        selecionados_filhos.push(item.id);
      });
      selecionados = selecionados_pais.join(",");
      selecionados = selecionados + selecionados_filhos.join(",");

      var input   =  document.createElement("input");
      input.type  = "text";
      input.id    = 'txt_selecionados';
      input.name  = 'txt_selecionados';
      input.value = selecionados;
      frm_permissao.appendChild(input);        
   }

</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout_sistema', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>