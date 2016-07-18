<?php
/**************************************************************************
*
* View.....: carregar_menu_form 
* Descrição: Atualiza a tabela tbmenus de acordo com o menu.xml
*
***************************************************************************/

$titulo = 'Carregar Menus';

?>


<?php $__env->startSection('content'); ?>

 <div class="row">
   <div class="col-md-10 col-md-offset-1">      
   
       <!-- título -->
      <div class="div_titulo">
          <?php echo e($titulo); ?> 
      </div>
         
      <div class="div_form">       
     
        
         <form id="frmCarregarMenu" action="<?php echo e(url('tools/carregar_menu')); ?>" method="POST"  role="form">
         <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
     
         <table border="0" width="100%">
            <tr>
               <td align="right" colspan="4">* campos obrigatórios</td>                
            </tr>
            <tr class='obrigatorio'>
               <td width="15%">Atualiza a tabela tbmenus, de acordo com o arquivo menu.xml</td>              
            </tr>
            
         </table> 

         <table border="0" width="100%">   
            <tr>                  
               <td>              
                  <hr class="hr1">
                  <div class="pull-right"> 
                     
                        <a href="/tools/" class="btn btn-default">Cancelar</a>
                        <button type="submit" id="btn_confirmar" class="btn btn-success">Confirmar</button>                     
                     
                  </div>
               </td>
            </tr>        
         </table>         
         </form> 
      </div>


<?php if(Session::has('mensagem')): ?>
  <p class="alert alert-info"><?php echo e(Session::get('mensagem')); ?></p>
<?php endif; ?>

      <?php if( count($errors) > 0): ?>         
         <div id="validar" class="panel panel-footer cor_branca">       
            Erros:<br />
            <ul  class="alert alert-danger">
               <?php foreach( $errors->all() as $e ): ?>                     
                  <li><?php echo e($e); ?></li>
               <?php endforeach; ?>
            </ul>
         </div>
      <?php endif; ?>
   </div>
</div>

<script>  

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout_tools', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>