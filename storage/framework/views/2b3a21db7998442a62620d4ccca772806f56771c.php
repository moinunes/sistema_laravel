<?php
/**************************************************************************************
*
* View.....: produto_exibir_form
* Descrição: Cadastro de produto
* Objetivo.: Exibir Formulário para: incluir, alterar, excluir, consultar e imprimir
*
***************************************************************************************/

use App\Core\Infra\Infra_Html; // provisório :  por o apelido no /var/www/laravel5/config/app.php:
use App\Core\Hlp\Hlp_View;

$titulo = 'Cadastro de Produto';

//dd($data->acao);
?>



<?php $__env->startSection('content'); ?>

<div class="row">
   <div class="col-md-10 col-md-offset-1">
      
      <!-- título -->
      <div class="div_titulo"><?php echo e(hlp_view::obter_titulo($data->acao)); ?> - <?php echo e($titulo); ?></div>
         
         
        
         <?php if( $data->acao == 'incluir' ): ?>           
             <?php echo Form::open( ['route' => 'produto.confirmar']); ?>

         <?php else: ?>
            <?php echo Form::model( $data, ['route' => [ 'produto.confirmar' ] ] ); ?>

            
         <?php endif; ?>

         <div class="div_form">  
            <!-- inputs hidden -->
            
            <input type="hidden" id="acao"       name="acao"       value="<?php echo e($data->acao); ?>">
            <input type="hidden" id="id_produto" name="id_produto" value="<?php echo e($data->id_produto); ?>" >
            <input type="hidden" id="readonly"   name="readonly"   value="<?php echo e($data->readonly); ?>" >

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
                                 <input  type='hidden' id="id_fornecedor"     name="id_fornecedor"     value="<?php echo e($data->id_fornecedor); ?>"     size="8"  maxlength="10" readonly='$data->readonly' >
                                 <input  type='text'   id="codigo_fornecedor" name="codigo_fornecedor" value="<?php echo e($data->codigo_fornecedor); ?>" size="8"  maxlength="10" readonly='$data->readonly' >
                              </td>
                              <td><input type='text'   id="nome_fornecedor" name="nome_fornecedor" value="<?php echo e($data->nome_fornecedor); ?>" size="40" maxlength="40" readonly='$data->readonly' ></td>
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
                  <td><input  type='text' id="codigo_produto" name="codigo_produto" value="<?php echo e($data->codigo_produto); ?>" size="8"  maxlength="10" <?php echo e($data->readonly); ?>></td>
                  
                  <td><?php echo Form::text( 'nome_produto', $data->nome_produto, ['class' => 'form-control', 'id' => 'nome_produto', 'autofocus' => '']); ?></td>
               </tr>               
            </table> 
         </div>
         
         <div class="div_rodape">
            <?php echo $__env->make('layouts.exibir_botoes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
         </div>

         <?php echo $__env->make('layouts.exibir_erros', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
         
      <?php echo Form::close(); ?>

      

   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout_sistema', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>