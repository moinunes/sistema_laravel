<?php

/******************************************************************************************************
*
* View.....: fornecedor_grid 
* Descrição: Cadastro de fornecedor
* Objetivo.: Montar Formulário de pesquisa e exibir registros na grid
*
******************************************************************************************************/

use App\Core\Infra\Infra_Html;

$titulo = 'Cadastro - Fornecedor';

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
            <td width="27%">Nome</td>
            <td width="63%"></td>
         </tr> 
         <tr>
           <td><?= Infra_Html::input_text( 'filtro_codigo', $filtros->filtro_codigo, 10, 10 ); ?></td>
           <td><?= Infra_Html::input_text( 'filtro_nome',   $filtros->filtro_nome,   30, 30 ); ?></td>                    
           <td><?= Infra_Html::input_submit( 'Filtrar', 'btn_filtrar' ); ?></td>                    
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
         <td width='10%'><?php Infra_Html::criar_titulo_grid( 'Código', 'codigo' );?></td>
         <td width='80%'><?php Infra_Html::criar_titulo_grid( 'Nome',   'nome' );?></td>
      </tr>
      <?php foreach( $data as $item ): ?>
         <tr>
            <td>
               <?php
               Infra_Html::criar_link_com_permissao( 'consultar', $item->id_fornecedor );
               Infra_Html::criar_link_com_permissao( 'alterar',   $item->id_fornecedor );
               Infra_Html::criar_link_com_permissao( 'excluir',   $item->id_fornecedor );
               ?>
            </td>
            <td><?php echo e($item->codigo); ?></td>
            <td><?php echo e($item->nome); ?></td>
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