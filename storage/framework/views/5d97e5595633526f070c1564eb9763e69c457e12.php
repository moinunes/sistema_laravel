<?php

/******************************************************************************************************
*
* View.....: uf_form
* Descrição: Cadastro de UF
* Objetivo.: Exibir Formulário para: incluir, alterar, excluir, consultar e imprimir
*
******************************************************************************************************/

use App\Core\Infra\Infra_Html;
use App\Core\Infra\Infra_View;

$titulo = 'Cadastro de UF';

Infra_Html::set_errors( $errors );

?>


<?php $__env->startSection('content'); ?>
   
<?=Infra_Html::exibir_titulo_form( $titulo, $data->acao ) ?>

<form action="<?php echo e(url('uf/confirmar')); ?>" method="post"  role="form" >

   <div class="div_form">
      <?=Infra_Html::exibir_string_campos_obrigatorios() ?>

      <!-- input hidden -->
      <?= Infra_Html::input_hidden( '_token',   csrf_token()    ); ?>
      <?= Infra_Html::input_hidden( 'acao',     $data->acao     ); ?>
      <?= Infra_Html::input_hidden( 'readonly', $data->readonly ); ?>
      <?= Infra_Html::input_hidden( 'id_uf',    $data->id_uf    ); ?>

      <!--  desenhar interface -->
      <!-- -->      
      <table border="0" width="100%">      
         <tr class='obrigatorio'>
            <td width="15%" <?php echo e(Infra_Html::obrigatorio('sigla_uf')); ?>>Sigla*</td>
            <td width="85%">Nome*</td>
         </tr>
         <tr>
            <td><?= Infra_Html::input_text( 'sigla_uf', $data->sigla_uf, 3,  2,  $data->readonly ); ?></td>                                
            <td><?= Infra_Html::input_text( 'nome_uf',  $data->nome_uf,  60, 60, $data->readonly ); ?></td>            
         </tr>               
      </table> 

   </div>

   <?php echo $__env->make('layouts.exibir_botoes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   <?php echo $__env->make('layouts.exibir_erros', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
         
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout_sistema', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>