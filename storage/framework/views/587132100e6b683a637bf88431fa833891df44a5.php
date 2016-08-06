<?php

/******************************************************************************************************
*
* View.....: produto_grid 
* Descrição: Cadastro de produtos
* Objetivo.: Montar Formulário de pesquisa e exibir registros na grid
*
******************************************************************************************************/

use App\Core\Infra\Infra_Html;

$titulo = 'Cadastro - Produtos';

?>


<?php $__env->startSection('content'); ?>

<div class="div_titulo"><?php echo e($titulo); ?></div>
         
<!-- monta os filtros para pesquisa -->
<!--  -->
<div class="div_filtro">

   <?= Infra_Html::Form( 'formulario' ); ?>
      
      <?= Infra_Html::input_hidden( '_token',  csrf_token() ); ?>

      <table class="table-responsive" width="100%" border="0">        
         <tr>
            <td width="10%">Código</td>
            <td width="30%">Nome</td>
            <td width="60%"></td>
         </tr> 
         <tr>
           <td><input  type='text' name="filtro_codigo" value="<?php echo e($filtros->filtro_codigo); ?>" size="10" maxlength="10" ></td>
           <td><input  type='text' name="filtro_descricao"   value="<?php echo e($filtros->filtro_descricao); ?>"   size="30" maxlength="30" ></td>
           <td><button type="submit" class="btn btn-success btn_filtrar">Filtrar</button></td>
         </tr>
      </table>

   </form>

</div>

<!-- monta o grid -->
<!--  -->
<div class="div_grid">
   <table class="table table-condensed table-bordered table-hover">            
      <tr class="cor_azul2">
         <td width='10%'>
            <?php Infra_Html::criar_link_com_permissao( 'incluir'  );?>
            <?php Infra_Html::criar_link_com_permissao( 'imprimir' );?>
         </td>               
         <td width='10%'><?php Infra_Html::criar_titulo_grid( 'Código',     'codigo'        );?></td>
         <td width='80%'><?php Infra_Html::criar_titulo_grid( 'Descrição',  'descricao'     );?></td>
         <td width='80%'><?php Infra_Html::criar_titulo_grid( 'Quantidade', 'quantidade'    );?></td>
         <td width='80%'><?php Infra_Html::criar_titulo_grid( 'Preço',      'preco'         );?></td>
         <td width='80%'><?php Infra_Html::criar_titulo_grid( 'Fornecedor', 'id_fornecedor' );?></td>

      </tr>
      <?php foreach( $data as $item ): ?>
         <tr>
            <td>
               <?php
               Infra_Html::criar_link_com_permissao( 'consultar', $item->id_produto );
               Infra_Html::criar_link_com_permissao( 'alterar',   $item->id_produto );
               Infra_Html::criar_link_com_permissao( 'excluir',   $item->id_produto );
               ?>
            </td>
            <td><?php echo e($item->codigo); ?></td>
            <td><?php echo e($item->descricao); ?></td>
            <td><?php echo e($item->quantidade); ?></td>
            <td><?php echo e($item->preco); ?></td>
            <td><?php echo e($item->fornecedor_nome); ?></td>
         </tr>
      <?php endforeach; ?>               
   </table>
</div>    

<!-- monta o paginador -->
<!--  -->
<div class="div_paginator">        
   <?php echo $data->links(); ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout_sistema', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>