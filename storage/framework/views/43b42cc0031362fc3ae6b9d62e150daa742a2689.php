<?php
/**************************************************************************
*
* View.....: permissoes_form 
* Descrição: Cadastro de permissões dos grupos
* Objetivo.: Exibir Formulário para: cadastrar permissões dos grupos de usuários
*
***************************************************************************/

use App\Libraries\Infra\Infra_Permissao;

$titulo   = 'Permissões';
$id_grupo = $table->id;

?>



<?php $__env->startSection('content'); ?>

<div class="row" >
   <div class="col-md-10 col-md-offset-1" >
      
      <!-- título -->   
      <div class="div_titulo"><?php echo e($titulo); ?></div>
      
      <form action="<?php echo e(url('permissao/confirmar')); ?>" method="post" role="form" >

         <div class="div_form">
            
            <!-- inputs hidden -->
            <input type="hidden" name="_token"   value="<?php echo e(csrf_token()); ?>">
            <input type="hidden" name="acao"     value="<?php echo e($acao); ?>">
            <input type="hidden" name="id_grupo" id="id_grupo" value="<?php echo e($id_grupo); ?>">  

            <table border="0" width="100%">
               <tr>
                  <td width="5%">Grupo:</td>    
                  <td width="95%" class='obrigatorio'><?php echo e($table->grupo); ?></td>    
               </tr>            
            </table> 
            
            <div id="tabs-1">
               <ul id="tree1" class="ul">
                  <?php
                  $permissao = new infra_Permissao();
                  $permissao->obter_menus_superior( $menus_superior, $id_grupo  );
                  ?>
                  <?php foreach( $menus_superior as $superior ): ?>
                     <?php $checked = $superior->permite != '' ? 'checked' : ''; ?>
                     <li class="li">
                        <input type="checkbox" id="txtPermissao_<?php echo e($superior->id_menu); ?>" name="txtPermissao_<?php echo e($superior->id_menu); ?>" <?php echo e($checked); ?> ><label><?php echo e($superior->titulo); ?></label>
                        <?php               
                        $permissao->obter_menus_itens( $menus_itens, $superior->id_menu, $id_grupo);
                        ?>
                        <?php foreach( $menus_itens as $itens ): ?>
                           <?php $checked = $itens->permite != '' ? 'checked' : ''; ?>
                           <ul>
                              <li class="li">
                                 <input type="checkbox" id="txtPermissao_<?php echo e($itens->id_menu); ?>" name="txtPermissao_<?php echo e($itens->id_menu); ?>" <?php echo e($checked); ?> ><label><?php echo e($itens->titulo); ?></label>
                                 <ul>
                                    <?php
                                    $permissao->obter_menus_itens( $sub_itens, $itens->id_menu, $id_grupo );
                                    ?>
                                    <?php foreach( $sub_itens as $sub ): ?>
                                       <?php $checked = $sub->permite != '' ? 'checked' : ''; ?>
                                       <li>
                                       <input type="checkbox" id="txtPermissao_<?php echo e($sub->id_menu); ?>" name="txtPermissao_<?php echo e($sub->id_menu); ?>" <?php echo e($checked); ?> ><label><?php echo e($sub->titulo); ?></label>
                                    <?php endforeach; ?>     
                                 </ul>
                              </li>
                           </ul>
                        <?php endforeach; ?>
                     </li>  
                  <?php endforeach; ?>
               </ul>           
            </div>

         </div>

         <?php echo $__env->make('layouts.exibir_botoes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </form>

   </div>
</div>

<script type="text/javascript">
   
   $(document).ready( function() {
      $('#tree1').checkboxTree();
   });

</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout_sistema', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>