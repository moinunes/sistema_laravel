<?php

/******************************************************************************************************
*
* View.....: permissao_grid 
* Descrição: Cadastro de permissões
* Objetivo.: Montar Formulário de pesquisa e exibir registros na grid
*
******************************************************************************************************/

use App\Core\Infra\Infra_Html;

$titulo = 'Cadastro - Permissões';

?>


<?php $__env->startSection('content'); ?>

<div class="div_titulo"><?php echo e($titulo); ?></div>
         
<!-- monta os filtros para pesquisa -->
<!--  -->
<div class="div_filtro">
         
   <form action="<?php echo e(url('permissao')); ?>" method="post" class="col-sm-12 form-horizontal" role="form">
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
      <table class="table-responsive" width="100%" border="0">
         <tr>
            <td width="10%">Grupo</td>
            <td width="28%"></td>
            <td width="62%"></td>
         </tr> 
         <tr>
           <td><input  type='text' name="filtro_grupo" value="<?php echo e($filtros->filtro_grupo); ?>"         size="10" maxlength="10" ></td>
           <td><input  type='text' name="filtro_descricao" value="<?php echo e($filtros->filtro_descricao); ?>" size="30" maxlength="30" ></td>
           <td><button type="submit" class="btn_filtrar">Filtrar</button></td>
         </tr>
      </table>
   </form>

</div>

<!-- exibe a grid da pesquisa -->
<div class="div_grid">  
   <table class="table table-condensed table-bordered table-hover">
      <tr class="cor_azul2">
          <th width='10%' align='center'>
          </th>                
          <th width='20%'><a href="/permissao/?order=grupo">Grupo</a></th>
          <th width='70%'><a href="/permissao/?order=descricao">Descrição</a></th>
      </tr>
 
      <?php foreach( $data as $item ): ?>                   
         <tr>
            <td>
               <!-- exibe os links [consultar,alterar,excluir] -->
               <?php
               Infra_Html::criar_link_com_permissao( 'alterar',   $item->id_grupo );
               ?>
            </td>              
            <td><?php echo e($item->grupo); ?></td>    
            <td><?php echo e($item->descricao); ?></td>               
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