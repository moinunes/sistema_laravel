<?php $__env->startSection('content'); ?>

<div class="container">
   <div class="row">
      <div class="col-md-6 col-md-offset-3">          
         
         <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login')); ?>">
            <div class="div_titulo">Login</div>    
            <div class="div_form">
                  <?php echo csrf_field(); ?>

                  <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                      <label class="col-md-2 control-label">E-mail</label>
                      <div class="col-md-9">
                          <input type="email"  class="form-control" name="email" value="<?php echo e(old('email')); ?>" >
                          <?php if($errors->has('email')): ?>
                              <span class="help-block">
                                  <strong><?php echo e($errors->first('email')); ?></strong>
                              </span>
                          <?php endif; ?>
                      </div>
                  </div>
                  <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                      <label class="col-md-2 control-label">Senha</label>
                      <div class="col-md-9">
                          <input type="password" class="form-control" name="password">
                          <?php if($errors->has('password')): ?>
                              <span class="help-block">
                                  <strong><?php echo e($errors->first('password')); ?></strong>
                              </span>
                          <?php endif; ?>
                      </div>
                  </div>                 
            </div>

            <div class="div_rodape">
                <table width="100%" border="0" >
                  <tr>
                     <td width="50%">                         
                        <button type="submit"  class="pull-right btn_confirmar">Entrar</button>
                     </td>
                  </tr>
                  </table>                         
            </div>
            
         </form>
        
      </div>
   </div>  
</div>  

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>