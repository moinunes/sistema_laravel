<?php $__env->startSection('content'); ?>

<?php

?>

<div class="row">
   <div class="col-md-10 col-md-offset-1">
      
      <div class="panel-body">               
         <table border="0"  width="100%">
            <tr height="5">
               <td width="15%">Objetivo:</td>               
               <td width="85%">- Aprender laravel 5</td>               
            </tr>
            <tr height="25">
               <td colspan="2"></td>                
            </tr>
            <tr>
               <td>Implementações:</td>
               <td>- Controle de Login</td>               
            </tr>
            <tr>
               <td><td>testar esse crud ---> https://blog.vagnerdocarmo.com.br/laravel-5-form-requests-basico/</td></td>
               
               <td>-   http://www.vedovelli.com.br</td>
            </tr>
           
         </table>
      </div>

   </div>
</div>

<?php if(Session::has('mensagem')): ?>
  <p class="alert alert-info"><?php echo e(Session::get('mensagem')); ?></p>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_sistema', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>