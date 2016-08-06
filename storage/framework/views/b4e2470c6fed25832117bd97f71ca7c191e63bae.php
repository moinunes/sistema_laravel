<?php
/**************************************************************************
*
* View.....: permissao_negada
* Descrição: exibe mensagem de acesso negado
*
***************************************************************************/

use App\Core\Infra\Infra_Permissao;

$titulo   = 'Permissão';

?>


<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-md-10 col-md-offset-1">      
   	
      <!-- título -->
    	<div class="div_titulo">
      	<?php echo e($titulo); ?>

    	</div>         
		
      <div class="div_form"> 
         <table width="20%">
            <tr>
               <td>Usuário:</td>
               <td><?php echo e($data->usuario); ?></td>
            </tr>
            <tr>
               <td>Acesso:</td>
               <td><?php echo e($data->rota); ?></td>
            </tr>         
            <tr>
               <td>Permissão:</td>            
               <td>Negada</td>            
            </tr>
         </table>
    	</div>

  	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout_sistema', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>