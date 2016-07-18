<?php
/**************************************************************************************
*
* View.....: user_exibir_form
* Descrição: Cadastro de Usuários
* Objetivo.: Exibir Formulário para: incluir, alterar, excluir, consultar e imprimir
*
***************************************************************************************/

use App\Libraries\Infra\Infra_Html; // provisório :  por o apelido no /var/www/laravel5/config/app.php:

$titulo = 'Cadastro de Usuários';
?>



<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-md-10 col-md-offset-1">
      
      <!-- título -->
      <div class="div_titulo"><?php echo e(hlp_view::obter_titulo($acao)); ?> - <?php echo e($titulo); ?></div>
         

      <form action="<?php echo e(url('user/confirmar')); ?>" method="post"  role="form">
      
         <div class="div_form">  
            <!-- inputs hidden -->
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <input type="hidden" name="acao"   value="<?php echo e($acao); ?>">
            <input type="hidden" name="id"     value="<?php echo e($data->id); ?>">

            <table border="0" width="100%">
               <tr><td align="right" colspan="2">* campos obrigatórios</td></tr>            
               
               <!--  
                  desenhar interface
               -->
               <tr class='obrigatorio'>
                  <td width="40%">Nome*</td>
                  <td width="60%">Email*</td>
               </tr>
               <tr>
                  <td><input  type='text' name="name"  value="<?php echo e($data->name); ?>"  size="50" maxlength="60" ></td>
                  <td><input  type='text' name="email" value="<?php echo e($data->email); ?>" size="40" maxlength="60" ></td>
               </tr>

               <tr>
                  <td colspan="2">
                     <tr class='obrigatorio'>
                        <td colspan="2">Senha*</td>
                     </tr>
                     <tr>
                        <td colspan="2"><input  type='password' name="password" value="<?php echo e($data->name); ?>"  size="40" maxlength="60" ></td>         
                     </tr>
                     <tr class='obrigatorio'>
                        <td colspan="2">Confirmar Senha*</td>
                     </tr>
                     <tr>
                        <td colspan="2"><input  type='password' name="password_confirmation" value="<?php echo e($data->email); ?>" size="40" maxlength="60" ></td>
                     </tr>               
                  </td>
               </tr>

            </table> 
         </div>

         <?php echo $__env->make('layouts.exibir_botoes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
         <?php echo $__env->make('layouts.exibir_erros', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
         
      </form>   

   </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_sistema', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>