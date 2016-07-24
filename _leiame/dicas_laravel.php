<?php

/*-----------------------
  dicas Laravel
------------------------*/


<?php

// Utilize o helper old, exemplo:
// Se houver validação e retornar será carregado o último valor digitado.
<input type="text" name="setor" value="{{old('setor')}}">
// controller deve devolver: withInput
return redirect()->route('signUp')->withInput();     ( withInput -> devolve os inputs ao form )
ou
return Redirect::to('form')->withInput();



$x = Produto::find(1)->options()->whereOption('fornecedor')->get();

$x = Produto::where( 'id_produto',1)->with('fornecedor')->get();

$x = Produto::join( 'fornecedor', 'tbproduto.id_fornecedor', '=', 'tbfornecedor.id_fornecedor' )
            ->where('tbproduto.id_produto','=', $id_produto )
            ->get();

$x = Produto::join( 'fornecedor', 'tbproduto.id_fornecedor', '=', 'tbfornecedor.id_fornecedor' )  
             ->select( 'produto.*', 'fornecedor.*')
             ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
             ->get();

$x = Produto::includes( 'fornecedor' )->where( 'produto.id_produto', '=', $id_produto )->get();            

$x Produto->artist()->associate($artist);

Produto.joins(:fornecedor).where(id_produto: $id_produto ).first




/*----------------- Obtém o registro  --------------------------*/

$x = Produto::where( ['id_produto' => $id_produto] ) ;
$x=Produto::find( $id_produto);

$x = Produto::find( $id_produto ) ;

$x = Produto::findOrNew( 1 ) ;


/*----------------- Obtém o ultimo registro  --------------------------*/
$x = Produto::latest()->first();              // ultimo registro
$x = Produto::latest()->first()->id_produto;  // ultimo id


    

/*----------------------------------------------------------------------*/
sites:
Vedovelli::

http://www.vedovelli.com.br/web-development/laravel-use-suas-proprias-classes-a-vontade/

http://pt.stackoverflow.com/questions/64900/d%C3%BAvidas-com-relacionamentos-no-eloquent


/*----------------------------------- tincker  --------------------------*/

--- Interagir com a aplicação

cd /var/www/sistema_laravel/    -- pasta da aplicação
php artisan tinker              -- entrar no tincker

echo Config::get('app.url');

// inserir usuario
$user = new App\User; 
$user->name     = 'Moisés';
$user->email    = 'moinunes@gmail.com';
$user->password = bcrypt('sucesso');
$user->save();




/*----------------------------------- migration  --------------------------*/
   https://laravel.com/docs/5.2/migrations#generating-migrations
  
   sudo php artisan make:migration create_tbmenu_table  -- criar tabela

   php artisan tinker                                 --> um console interativo do próprio Laravel
   php artisan migrate                                --> migra todas as tabelas
   php artisan migrate:rollback                       --> rollback
   sudo php artisan make:migration create_users_table --> To create a migration
   php artisan migrate                                --> cria/Recria as tables com os scripts da pasta /migrations
   php artisan app:name detlub                        --> mudar o mudar o 'namespace' da aplicação
   php artisan env                                    --> exibe o ambiente corrente
   php artisan make:controller UserController         --> criando um controller
   php artisan make:model Nomemodel                   --> cria Model, tabela e script obs: make:model cria também a migration(script da tabela)
   php artisan route:list                             --> listar rotas
   php artisan migrate:refresh                        --> ao modificar um script, ( para atualizar as estruturas das tabelas )






