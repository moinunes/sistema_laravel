<?php
/**************************************************************************************
*
* View.....: uf_exibir_form
* Descrição: Cadastro de UF
* Objetivo.: Exibir Formulário para: incluir, alterar, excluir, consultar e imprimir
*
***************************************************************************************/

use App\Libraries\Infra\Infra_Html; // provisório :  por o apelido no /var/www/laravel5/config/app.php:

$titulo = 'Cadastro de Fornecedor';
?>



<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-md-10 col-md-offset-1">
      
      <!-- título -->
      <div class="div_titulo"><?php echo e(hlp_view::obter_titulo($acao)); ?> - <?php echo e($titulo); ?></div>         

      <form action="<?php echo e(url('fornecedor/confirmar')); ?>" method="post"  role="form">
      
         <div class="div_form">  
            <!-- inputs hidden -->
            <input type="hidden" name="_token"        value="<?php echo e(csrf_token()); ?>">
            <input type="hidden" name="acao"          value="<?php echo e($acao); ?>">
            <input type="hidden" name="id_fornecedor" value="<?php echo e($data->id_fornecedor); ?>">

            <table border="0" width="100%">
               <tr><td align="right" colspan="2">* campos obrigatórios</td></tr>            
               
               <!--  desenhar interface -->
               <tr class='obrigatorio'>
                  <td width="15%">Código*</td>
                  <td width="85%">Nome*</td>
               </tr>
               <tr>
                  <td><input  type='text' name="codigo_fornecedor" value="<?php echo e($data->codigo_fornecedor); ?>" size="10" maxlength="10" <?php echo e($readonly); ?> ></td>
                  <td><input  type='text' name="nome_fornecedor"   value="<?php echo e($data->nome_fornecedor); ?>"   size="60" maxlength="60" <?php echo e($readonly); ?> ></td>
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