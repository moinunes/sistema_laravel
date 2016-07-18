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
   criar_janela_modal();      
   _filtro_codigo_fornecedor = $("#filtro_codigo_fornecedor").val();
   _filtro_nome_fornecedor   = $("#filtro_nome_fornecedor").val(); 
   ajax = $.ajax({
      type: "PUT",
      async: true,
      dataType: "html",
      url: "/busca/filtrar/",
      data: { 
               acao:'buscar_fornecedor',
               order:_order,
               filtro_codigo_fornecedor:_filtro_codigo_fornecedor,
               filtro_nome_fornecedor:_filtro_nome_fornecedor,
            },
      beforeSend: function( xhr ) { $("#div_grid").html('aguarde. filtrando...'); },
      success: function(resultado){            
         $("#div_buscar").html( resultado );
         $("#filtro_codigo_fornecedor").val( _filtro_codigo_fornecedor );
         $("#filtro_nome_fornecedor").val( _filtro_nome_fornecedor );
      },
      failure: function( errMsg ) { alert(errMsg); } 
   });
} // buscar_fornecedor

/*--------------------------------------------------------------------------------------------
* retorna busca do fornecedor
--------------------------------------------------------------------------------------------*/
$(".btn_fornecedor").click(function(event) {
   $("#id_fornecedor"    ).val( $(this).attr("data-id"       ) );
   $("#codigo_fornecedor").val( $(this).attr("data-codigo"    ) );
   $("#nome_fornecedor"  ).val( $(this).attr("data-descricao") );   
   //.. limpar filtros
   $("#filtro_codigo_fornecedor").val('');
   $("#filtro_nomeo_fornecedor").val(''); 
   //.. fecha janela
   $( "#div_buscar" ).dialog( "close" );
});

   