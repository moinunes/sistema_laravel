<?php

/**************************************************************************************************
*
* exibir_erros.blade.php
*
* objetivo: Exibir os erros das views
*
***************************************************************************************************/
?>

<?php if( count($errors) > 0): ?>
   <br/>
   <div  class="div_erros">
   <ul>
      <?php foreach( $errors->all() as $e ): ?>
         <li><?php echo e($e); ?></li>
      <?php endforeach; ?>
   </ul>   
   </div>
<?php endif; ?>