<?php

/******************************************************************************************************
*
* View.....: fornecedor_form
* Descrição: Cadastro de Fornecedor
* Objetivo.: Exibir Formulário para: incluir, alterar, excluir, consultar e imprimir
*
******************************************************************************************************/

use App\Core\Infra\Infra_Html;
use App\Core\Infra\Infra_View;

$titulo = 'Cadastro de Fornecedor';

Infra_Html::set_errors( $errors );

?>


<?php $__env->startSection('content'); ?>

<?=Infra_Html::exibir_titulo_form( $titulo, $data->acao ) ?>

<form action="<?php echo e(url('fornecedor/confirmar')); ?>" method="post"  role="form">
   
   <div class="div_form">
      <?=Infra_Html::exibir_string_campos_obrigatorios() ?>

      <!-- input hidden -->
      <?= Infra_Html::input_hidden( '_token',        csrf_token()         ); ?>
      <?= Infra_Html::input_hidden( 'acao',          $data->acao          ); ?>
      <?= Infra_Html::input_hidden( 'readonly',      $data->readonly      ); ?>
      <?= Infra_Html::input_hidden( 'id_fornecedor', $data->id_fornecedor ); ?>

      <!--  desenhar interface -->
      <!-- -->              
      <table border="0" width="100%">
         <tr class='obrigatorio'>
            <td width="15%" class="<?php echo e(Infra_Html::obrigatorio('codigo')); ?>" >Código*</td>
            <td width="85%" class="<?php echo e(Infra_Html::obrigatorio('nome')); ?>"   >Nome*  </td>
         </tr>
         <tr>
            <td><?= Infra_Html::input_text( 'codigo', $data->codigo, 10, 10, $data->readonly ); ?></td>
            <td><?= Infra_Html::input_text( 'nome',   $data->nome,   60, 60, $data->readonly ); ?></td>
         </tr>               
      </table> 
   </div>

   <?php echo $__env->make('layouts.exibir_botoes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   <?php echo $__env->make('layouts.exibir_erros', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   
</form>   

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_sistema', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>