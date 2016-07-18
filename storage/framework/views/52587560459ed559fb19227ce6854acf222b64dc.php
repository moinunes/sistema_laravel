<?php

/**************************************************************************************************
*
* exibir_botoes.blade.php
*
* objetivo: Exibir os botões 'Cancelar  Confirmar ou Voltar' de acordo com a ação
*
***************************************************************************************************/

$controller = Request::segment(1);

?>

<?php if( $data->acao == 'consultar' ): ?>                  
   
   <table width="100%" border="0" class="cor_titulo">
      <tr>
         <td width="50%">
            <a href="/<?=$controller ?>/cancelar" class="pull-right btn_voltar">Voltar</a>
         </td>
      </tr>
   </table>
<?php else: ?>
   <table width="100%" border="0" >
      <tr>
         <td width="50%">
            <a href="/<?=$controller ?>/cancelar" class="btn_cancelar">Cancelar</a>
         </td>
         <td width="50%" align="right">
            <button type="submit"  class="pull-right btn_confirmar">Confirmar</button>
         </td>
      </tr>
   </table>
<?php endif; ?>             