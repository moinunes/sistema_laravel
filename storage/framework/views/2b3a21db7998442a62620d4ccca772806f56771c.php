<?php

/******************************************************************************************************
*
* View.....: produto_form
* Descrição: Cadastro de produto
* Objetivo.: Exibir Formulário para: incluir, alterar, excluir, consultar e imprimir
*
******************************************************************************************************/

use App\Core\Infra\Infra_Html;
use App\Core\Infra\Infra_View;

$titulo = 'Cadastro de Produto';

Infra_Html::set_errors( $errors );

//print_r($data);die();
?>


<?php $__env->startSection('content'); ?>

<?=Infra_Html::exibir_titulo_form( $titulo, $data->acao ) ?>

<form action="<?php echo e(url('produto/confirmar')); ?>" method="post"  role="form" >

   <div class="div_form">
      <?=Infra_Html::exibir_string_campos_obrigatorios() ?>

      <!-- input hidden -->
      <?= Infra_Html::input_hidden( '_token',     csrf_token()      ); ?>
      <?= Infra_Html::input_hidden( 'acao',       $data->acao       ); ?>
      <?= Infra_Html::input_hidden( 'readonly',   $data->readonly   ); ?>
      <?= Infra_Html::input_hidden( 'id_produto', $data->id_produto ); ?>

      <div id="div_buscar" name="div_buscar" title="Buscar"></div>
      
      <!--  desenhar interface -->
      <!-- -->       
      <table border="0" width="100%">
         <tr>
            <td colspan="2">
               <fieldset class="fsStyle" style="width:45%">
                  <legend class="legendStyle <?php echo e(Infra_Html::obrigatorio('id_fornecedor')); ?>" >Fornecedor*</legend>
                  <table border="0" width="100%">
                     <tr >
                        <td width="30%" >Código</td>
                        <td width="65%">Descrição<td>
                        <td width="5%"></td>
                     </tr>
                     <tr>
                        <td>
                           <input  type='hidden' id="id_fornecedor"     name="id_fornecedor"     value="<?php echo e($data->id_fornecedor); ?>"     size="8"  maxlength="10" readonly='$data->readonly' >
                           <input  type='text'   id="fornecedor_codigo" name="fornecedor_codigo" value="<?php echo e($data->fornecedor_codigo); ?>" size="8"  maxlength="10" readonly='$data->readonly' >
                        </td>
                        <td><input type='text'   id="fornecedor_nome" name="fornecedor_nome" value="<?php echo e($data->fornecedor_nome); ?>" size="40" maxlength="40" readonly='$data->readonly' ></td>
                        <td>
                           <input type="button" onclick="buscar_fornecedor()" value=">>" />
                        </td>
                     </tr>               
                  </table>
               </fieldset>
            </td>
         </tr>

         <tr class='obrigatorio'>
            <td width="15%" class="<?php echo e(Infra_Html::obrigatorio('codigo')); ?>" >Código*   </td>
            <td width="85%" class="<?php echo e(Infra_Html::obrigatorio('descricao')); ?>"   >Descrição*</td>
         </tr>         
         <tr>
            <td><input  type='text' id="codigo" name="codigo" value="<?php echo e($data->codigo); ?>" size="8"  maxlength="10" <?php echo e($data->readonly); ?>></td>
            <td><input  type='text' id="descricao"   name="descricao"   value="<?php echo e($data->descricao); ?>" size="60"  maxlength="60" <?php echo e($data->readonly); ?>></td>           
         </tr>

         <tr class='padrao'>
            <td width="15%">Quantidade</td>
            <td width="85%" class="<?php echo e(Infra_Html::obrigatorio('descricao')); ?>">Preço</td>
         </tr>         
         <tr>
            <td><input  type='text' id="quantidade" name="quantidade" value="<?php echo e($data->quantidade); ?>" size="12"  maxlength="12" <?php echo e($data->readonly); ?>></td>
            <td><input  type='text' id="preco"      name="preco"      value="<?php echo e($data->preco); ?>"      size="12"  maxlength="12" <?php echo e($data->readonly); ?>></td>            
         </tr>

      </table> 
         
   </div>

   <?php echo $__env->make('layouts.exibir_botoes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   <?php echo $__env->make('layouts.exibir_erros', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
         
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout_sistema', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>