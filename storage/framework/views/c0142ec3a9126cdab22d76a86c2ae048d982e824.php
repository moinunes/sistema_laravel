<?php

/**************************************************************************
*
* View.....: grupo_exibir_grid 
* Descrição: Cadastro de grupo
* Objetivo.: Montar Formulário de pesquisa e exibir registros na grid
*
***************************************************************************/

use App\Core\Infra\Infra_Html; // provisório :  por o apelido no /var/www/laravel5/config/app.php:

$titulo = 'Cadastro - Grupo';

?>


<?php $__env->startSection('content'); ?>

<div class="row">  
   <div class="col-md-10 col-md-offset-1">

         <div class="div_titulo"><?php echo e($titulo); ?></div>
         <!-- monta os filtros para pesquisa -->
         <div class="div_filtro">
            
            <form action="<?php echo e(url('grupo')); ?>" method="post" class="col-sm-12 form-horizontal" role="form">

            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

               <table class="table-responsive" width="50%" border="0">
                  <tr>
                     <td width="25%">Grupo</td>
                     <td width="25%">Descrição</td>
                     <td width="10%"></td>
                  </tr> 
                  <tr>
                    <td><input  type='text' name="filtro_grupo"     value="<?php echo e($filtros->filtro_grupo); ?>"     size="8"   maxlength="10" ></td>
                    <td><input  type='text' name="filtro_descricao" value="<?php echo e($filtros->filtro_descricao); ?>" size="40"  maxlength="50" ></td>
                    <td><button type="submit" class="btn btn-success btn_filtrar">Filtrar</button></td>                  
               </table>
           </form>
         </div>

         <div class="div_grid">  
      
          <!-- exibe a grid da pesquisa -->
          <table class="table table-condensed table-bordered table-hover">
              <thead>
                  <tr class="cor_azul2">
                      <th width='20%'  >
                        <?php
                        //Infra_Html::criar_link_com_permissao( 'incluir'  );
                        //Infra_Html::criar_link_com_permissao( 'imprimir' );
                        ?>
                        <a href='/grupo/incluir'><span class='btn btn-success glyphicon glyphicon-plus btn_incluir'></span></a>
                        <a href='/grupo/imprimir'><span class='btn glyphicon glyphicon-print'></span></a>
                      </th>                      
                      <th width='20%'><a href="/grupo/?ordem=grupo">Grupo</a></th>
                      <th width='60%'><a href="/grupo/?ordem=descricao">Descrição</a></th>                        
                  </tr>

              </thead>

              <tbody>
                  <?php foreach( $data as $item ): ?>                   
                    <tr>
                      <td>
                         <?php
                             Infra_Html::criar_link_com_permissao( 'consultar', $item->id_grupo );
                              Infra_Html::criar_link_com_permissao( 'alterar',   $item->id_grupo );
                             Infra_Html::criar_link_com_permissao( 'excluir',   $item->id_grupo );
                              ?>
                      </td>              
                      <td><?php echo e($item->grupo); ?></td>
                      <td><?php echo e($item->descricao); ?></td>
                  </tr>
                 <?php endforeach; ?>

              </tbody>

           </table>
      </div>    

      <div class="div_paginator">        
         <?php echo $data->links(); ?>

      </div>
      
   </div>    
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout_sistema', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>