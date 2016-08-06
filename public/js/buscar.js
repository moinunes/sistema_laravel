/*
* programa: buscar.js
* objetivo: montar estrutura de busca (ajax) do sistema
*           abre uma janela modal para pesquisar: fornecedor, uf, cliente, etc...
*/

/*--------------------------------------------------------------------------------------------
* busca do fornecedor
* param    boolean      define se vai filtrar os dados         
--------------------------------------------------------------------------------------------*/
function buscar_fornecedor( _order = null ) {
   //alert($("#filtro_codigo").val());
   criar_janela_modal();      
   _filtro_codigo = $("#filtro_codigo").val();
   _filtro_nome   = $("#filtro_nome").val(); 
   ajax = $.ajax({
      type: "PUT",
      async: true,
      dataType: "html",
      url: "/busca/filtrar/",
      data: { 
               acao:'buscar_fornecedor',
               order:_order,
               filtro_codigo:_filtro_codigo,
               filtro_nome:_filtro_nome,
            },
      beforeSend: function( xhr ) { $("#div_grid").html('aguarde. filtrando...'); },
      success: function(resultado){            
         $("#div_buscar").html( resultado );
         $("#filtro_codigo").val( _filtro_codigo );
         $("#filtro_nome").val( _filtro_nome );
      },
      failure: function( errMsg ) { alert(errMsg); } 
   });
} // buscar_fornecedor

/*--------------------------------------------------------------------------------------------
* retorna busca do fornecedor
--------------------------------------------------------------------------------------------*/
$(".btn_fornecedor").click(function(event) {
   $("#id_fornecedor"    ).val( $(this).attr("data-id"       ) );
   $("#fornecedor_codigo").val( $(this).attr("data-codigo"    ) );
   $("#fornecedor_nome"  ).val( $(this).attr("data-descricao") );   
   //.. limpar filtros
   $("#filtro_codigo").val('');
   $("#filtro_nomeo_fornecedor").val(''); 
   //.. fecha janela
   $( "#div_buscar" ).dialog( "close" );
});

   