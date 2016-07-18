/*
* programa: sistema.js
* objetivo: manter as funções javascripts genéricas do sistema
*         
*/
//.. setup do ajax
$.ajaxSetup({
   headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});

  
/*
* cria a janela modal
* param    int    altura  da modal
* param    int    largura da modal         
*/
function criar_janela_modal( _height=550, _width=700 ) {
   $( "#div_buscar" ).dialog( {
      autoOpen: false,
      modal:true,
      height:_height,
      width:_width,
      buttons: {
         voltar: function() {
            $( "#div_buscar" ).dialog( "close" );
         }
      },
      close: function() {
         $(this).dialog( "close" );
      }
   });
   $( "#div_buscar" ).dialog( "open" );
} // criar_janela_modal

function carregar_js( _nome_arquivo ) {
   $.getScript( "/js/"+_nome_arquivo )
      .done( function( script, textStatus ) {
         if (textStatus!='success') {
            alert(textStatus);          
         }            
      })
      .fail(function( jqxhr, settings, exception ) {
         alert( exception);
      });
} // carregar_js
