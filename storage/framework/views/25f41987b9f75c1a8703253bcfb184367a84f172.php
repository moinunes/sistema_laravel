<?php
/**************************************************************************************
*
* View.....: produto_exibir_form
* Descrição: Cadastro de produto
* Objetivo.: Exibir Formulário para: incluir, alterar, excluir, consultar e imprimir
*
***************************************************************************************/

use App\Core\Infra\Infra_Html; // provisório :  por o apelido no /var/www/laravel5/config/app.php:

$titulo = 'Cadastro de Produto';
?>



<?php $__env->startSection('content'); ?>

<div class="row">
   <div class="col-md-10 col-md-offset-1">
      
      <!-- título -->
      <div class="div_titulo"><?php echo e(hlp_view::obter_titulo($acao)); ?> - <?php echo e($titulo); ?></div>
         

      <form id="frmProduto" name="frmProduto" action="<?php echo e(url('produto/confirmar')); ?>" method="post"  role="form">
         <div class="div_form">  
            <!-- inputs hidden -->
            <input type="hidden" id="_token"     name="_token"     value="<?php echo e(csrf_token()); ?>">
            <input type="hidden" id="acao"       name="acao"       value="<?php echo e($acao); ?>">
            <input type="hidden" id="produto_id" name="produto_id" value="<?php echo e($produto->produto_id); ?>">

            <div id="div_buscar" name="div_buscar" title="Buscar"></div>
            
            <table border="0" width="100%">
               <tr><td align="right" colspan="2">* campos obrigatórios</td></tr>

               <!--  
                  desenhar interface
               -->
               <tr>
                  <td colspan="2">
                     <fieldset class="fsStyle" style="width:45%">
                        <legend class="legendStyle">Fornecedor*</legend>
                        <table border="0" width="100%">
                           <tr class='padrao'>
                              <td width="30%">Código</td>
                              <td width="65%">Descrição</td>
                              <td width="5%"></td>
                           </tr>
                           <tr>
                              <td>
                                 <input  type='hidden' id="fornecedor_id"     name="fornecedor_id"     value="<?php echo e($fornecedor->fornecedor_id); ?>"     size="8"  maxlength="10" readonly='readonly' >
                                 <input  type='text'   id="fornecedor_codigo" name="fornecedor_codigo" value="<?php echo e($fornecedor->fornecedor_codigo); ?>" size="8"  maxlength="10" readonly='readonly' >
                              </td>
                              <td><input type='text'   id="fornecedor_descricao" name="fornecedor_descricao" value="<?php echo e($fornecedor->fornecedor_descricao); ?>" size="40" maxlength="40" readonly='readonly' ></td>
                              <td>
                                 <input type="button" onclick="buscar_fornecedor()" value=">>" />
                              </td>
                           </tr>               
                        </table>
                     </fieldset>
                  </td>
               </tr>

               <tr class='obrigatorio'>
                  <td width="15%">Código*</td>
                  <td width="85%">Descrição*</td>
               </tr>
               <tr>
                  <td><input  type='text' name="produto_codigo"    name="produto_codigo"     value="<?php echo e($produto->produto_codigo); ?>"     size="8"  maxlength="10" ></td>
                  <td><input  type='text' name="produto_descricao" name="produto_descricao" value="<?php echo e($produto->produto_descricao); ?>" size="60" maxlength="60" ></td>
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