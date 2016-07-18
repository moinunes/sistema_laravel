<?php

/**************************************************************************
*
* View.....: busca_grid 
* 
* Objetivo.: Montar Formulário de pesquisa e exibir registros na grid
*
***************************************************************************/
$titulo = 'Buscar Fornecedor';
?>

<?php $__env->startSection('content'); ?>
<body>            
         <div class="div_titulo"><?php echo e($titulo); ?></div>
         
         <!-- monta os filtros para pesquisa -->         
         <div class="div_filtro">
               <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
               <table class="table-responsive" width="100%" border="0">
                  <tr>
                     <td width="25%">Código</td>
                     <td width="65%">Descrição</td>
                     <td width="10%"></td>
                  </tr> 
                  <tr>
                    <td><input type='text'   id="filtro_codigo_fornecedor" name="filtro_codigo_fornecedor" value="<?php echo e($filtros->filtro_codigo_fornecedor); ?>" size="8"  maxlength="10" ></td>
                    <td><input type='text'   id="filtro_nome_fornecedor"   name="filtro_nome_fornecedor"   value="<?php echo e($filtros->filtro_nome_fornecedor); ?>"   size="30" maxlength="30" ></td>
                    <td><input type="button" id="btn_filtrar"      name="btn_filtrar"      onclick="buscar_fornecedor()" value="Filtrar" class="btn btn-success btn_filtrar"  ></td>
                  </tr>
               </table>
            
         </div>

         <div class="div_busca_titulo" >      
            <table class="table table-condensed">
               <tr class="cor_azul2">
                  <th width='10%'></th>                      
                  <th width='20%'><input type="button" onclick="buscar_fornecedor('codigo_fornecedor')" value="Código"    class="btn_buscar_titulo"></th>
                  <th width='70%'><input type="button" onclick="buscar_fornecedor('nome_fornecedor'  )" value="Descricao" class="btn_buscar_titulo"></th>
               </tr>               
            </table>
         </div>

         <div class="div_busca_grid" id="div_grid">
            <table class="table table-condensed table-bordered table-hover">
               <tbody>                  
                  <?php foreach( $data as $item ): ?>
                     <tr>
                        <td width='10%'><button type="button" class="btn_fornecedor btn_buscar" data-id="<?php echo e($item->id_fornecedor); ?>" data-codigo="<?php echo e($item->codigo_fornecedor); ?>" data-descricao="<?php echo e($item->nome_fornecedor); ?>">ok</button></td>
                        <td width='20%'><?php echo e($item->codigo_fornecedor); ?></td>
                        <td width='70%'><?php echo e($item->nome_fornecedor); ?></td>                
                     </tr>
                  <?php endforeach; ?>                  
               </tbody>
            </table>
      </div>    

      
      </body>
    


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout_busca', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>