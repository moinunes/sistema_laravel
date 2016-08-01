<?php

/******************************************************************************************************
*
* exibir_erros.blade.php
*
* objetivo: Exibir os erros das views
*
******************************************************************************************************/
?>

@if ( count($errors) > 0)
   <br/>
   <div  class="div_erros">
   <ul>
      @foreach ( $errors->all() as $e )
         <li>{{ $e }}</li>
      @endforeach
   </ul>   
   </div>
@endif