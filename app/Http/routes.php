<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
  //  return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/



Route::group(['middleware' => 'web'], function () {

   // autenticação
   Route::auth();

   // home page
   Route::get( '/',    'HomeController@index' );
   Route::get( 'home', 'HomeController@index' );

   // busca
   Route::any('busca/filtrar',     'BuscaController@filtrar' )->name('busca.filtrar');
      
   // user
   Route::any('user',              'UserController@exibir_grid' )->name('user.exibir_grid');
   Route::get('user/cancelar',     'UserController@cancelar'    )->name('user.cancelar'); 
   Route::get('user/imprimir',     'UserController@imprimir'    )->name('user.imprimir'); 
   Route::get('user/{acao}/{id?}', 'UserController@exibir_form' )->name('user.exibir_form'); 
   Route::post('user/confirmar',   'UserController@confirmar'   )->name('user.confirmar'  );

   // grupo
   Route::any('grupo',              'GrupoController@exibir_grid' )->name('grupo.exibir_grid');
   Route::get('grupo/cancelar',     'GrupoController@cancelar'    )->name('grupo.cancelar'); 
   Route::get('grupo/imprimir',     'GrupoController@imprimir'    )->name('grupo.imprimir'); 
   Route::get('grupo/{acao}/{id?}', 'GrupoController@exibir_form' )->name('grupo.exibir_form'); 
   Route::post('grupo/confirmar',   'GrupoController@confirmar'   )->name('grupo.confirmar'  );

   //.. permissao de grupo
   Route::any('permissao',              'PermissaoController@exibir_grid' )->name('permissao.exibir_grid');
   Route::get('permissao/cancelar',     'PermissaoController@cancelar'    )->name('permissao.cancelar'); 
   Route::get('permissao/negada',       'PermissaoController@negada'      )->name('permissao.negada'); 
   Route::get('permissao/{acao}/{id?}', 'PermissaoController@exibir_form' )->name('permissao.exibir_form'); 
   Route::post('permissao/confirmar',   'PermissaoController@confirmar'   )->name('permissao.confirmar'  );   

   // uf
   Route::any('uf',              'UfController@exibir_grid' )->name('uf.exibir_grid');
   Route::get('uf/cancelar',     'UfController@cancelar'    )->name('uf.cancelar'); 
   Route::get('uf/imprimir',     'UfController@imprimir'    )->name('uf.imprimir'); 
   Route::get('uf/{acao}/{id?}', 'UfController@exibir_form' )->name('uf.exibir_form'); 
   Route::post('uf/confirmar',   'UfController@confirmar'   )->name('uf.confirmar'  );

   // fornecedor
   Route::any('fornecedor',              'FornecedorController@exibir_grid' )->name('Fornecedor.exibir_grid');
   Route::get('fornecedor/cancelar',     'FornecedorController@cancelar'    )->name('Fornecedor.cancelar'); 
   Route::get('fornecedor/imprimir',     'FornecedorController@imprimir'    )->name('Fornecedor.imprimir'); 
   Route::get('fornecedor/{acao}/{id?}', 'FornecedorController@exibir_form' )->name('Fornecedor.exibir_form'); 
   Route::post('fornecedor/confirmar',   'FornecedorController@confirmar'   )->name('Fornecedor.confirmar'  );   


   // produto
   Route::any('produto',              'ProdutoController@exibir_grid' )->name('Produto.exibir_grid');
   Route::get('produto/cancelar',     'ProdutoController@cancelar'    )->name('Produto.cancelar'); 
   Route::get('produto/imprimir',     'ProdutoController@imprimir'    )->name('Produto.imprimir'); 
   Route::get('produto/{acao}/{id?}', 'ProdutoController@exibir_form' )->name('Produto.exibir_form'); 
   Route::post('produto/confirmar{id?}',   'ProdutoController@confirmar'   )->name('produto.confirmar'  );   
  
   //.. tools
   Route::resource( 'tools', 'ToolsController' );
   Route::post('tools/carregar_menu',   'ToolsController@carregar_menu'   )->name('Tools.carregar_menu'  );   

});
