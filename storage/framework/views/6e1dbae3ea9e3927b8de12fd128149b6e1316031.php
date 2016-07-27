<?php

/**************************************************************************
*
* View.....: user_grid 
* Descrição: Cadastro de Usuários
* Objetivo.: Montar Formulário de pesquisa e exibir registros na grid
*
***************************************************************************/

use App\Core\Infra\Infra_Html; // provisório :  por o apelido no /var/www/laravel5/config/app.php:

$titulo = 'Cadastro - Usuários';

?>


<?php $__env->startSection('content'); ?>

<div class="row">  
   <div class="col-md-10 col-md-offset-1">

         <div class="div_titulo"><?php echo e($titulo); ?></div>
         
         <!-- monta os filtros para pesquisa -->         
         <div class="div_filtro">
            <form action="<?php echo e(url('user')); ?>" method="post" class="col-sm-12 form-horizontal" role="form">
               <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
               <table class="table-responsive" width="50%" border="0">
                  <tr>
                     <td width="25%">Nome</td>
                     <td width="65%">Email</td>
                     <td width="10%"></td>
                  </tr> 
                  <tr>
                    <td><input  type='text' name="filtro_name"  value="<?php echo e($filtros->filtro_name); ?>"  size="30" maxlength="30" ></td>
                    <td><input  type='text' name="filtro_email" value="<?php echo e($filtros->filtro_email); ?>" size="30" maxlength="30" ></td>                  
                    <td><button type="submit" class="btn btn-success btn_filtrar">Filtrar</button></td>
                  </tr>
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
                        <a href='/user/incluir'><span class='btn btn-success glyphicon glyphicon-plus'></span></a>
                        <a href='/user/imprimir'><span class='btn glyphicon glyphicon-print'></span></a>
                        </th>                      
                        <th width='20%'><a href="/user/?ordem=name">Nome</a></th>
                        <th width='60%'><a href="/user/?ordem=email">Email</a></th>                         
                     </tr>
               </thead>

               <tbody>
                  <?php foreach( $data as $item ): ?>                   
                     <tr>
                        <td>
                           <?php
                           Infra_Html::criar_link_com_permissao( 'consultar', $item->id );
                           Infra_Html::criar_link_com_permissao( 'alterar',   $item->id );
                           Infra_Html::criar_link_com_permissao( 'excluir',   $item->id );
                           ?>
                        </td>              
                        <td><?php echo e($item->name); ?></td>
                        <td><?php echo e($item->email); ?></td>                
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