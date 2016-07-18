<?php
/**************************************************************************
*
* View.....: tools_home_blade 
* Descrição: ferramentas do sistema
*
***************************************************************************/

$titulo = 'Ferramentas do Sistema';

?>


<?php $__env->startSection('content'); ?>

 <div class="row">
   <div class="col-md-10 col-md-offset-1">      
   
       <!-- título -->
      <div class="div_titulo">
         <?php echo e($titulo); ?> 
      </div>
   </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout_tools', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>