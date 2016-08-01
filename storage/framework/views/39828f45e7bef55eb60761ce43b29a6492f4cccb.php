<?php

/******************************************************************************************************
*
* View.....: uf_grid 
* Descrição: Cadastro de uf
* Objetivo.: Montar Formulário de pesquisa e exibir registros na grid
*
******************************************************************************************************/

use App\Core\Infra\Infra_Html;

$titulo = 'Cadastro - UF';

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
            <td width="5%">Sigla</td>
            <td width="30%">Nome</td>
            <td width="65%"></td>
         </tr> 
         <tr>
           <td><?= Infra_Html::input_text( 'filtro_sigla_uf', $filtros->filtro_sigla_uf, 4,  2  ); ?></td>
           <td><?= Infra_Html::input_text( 'filtro_nome_uf',  $filtros->filtro_nome_uf,  30, 30 ); ?></td>                    
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
         <td width='10%'><?php Infra_Html::criar_titulo_grid( 'Sigla', 'sigla_uf' );?></td>
         <td width='80%'><?php Infra_Html::criar_titulo_grid( 'Nome', 'nome_uf' );?></td>
      </tr>
      <?php foreach( $data as $item ): ?>
         <tr>
            <td>
               <?php
               Infra_Html::criar_link_com_permissao( 'consultar', $item->id_uf );
               Infra_Html::criar_link_com_permissao( 'alterar',   $item->id_uf );
               Infra_Html::criar_link_com_permissao( 'excluir',   $item->id_uf );
               ?>
            </td>
            <td><?php echo e($item->sigla_uf); ?></td>
            <td><?php echo e($item->nome_uf); ?></td>
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