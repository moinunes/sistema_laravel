<?
//********************************************************************************************************************************
// 
// Objetivo: reunir informações úteis para o desenvolvedor PHP
//
// Autor...: Moisés Nunes
//
//
//********************************************************************************************************************************



--------------------------- POSTGRES: ----------------------------------------------------

	- corrigir encoding do postgres -> encontrei esse site:
	       http://www.vivaolinux.com.br/artigo/Encoding-do-Postgres-(latin1)-e-encoding-do-SO-(Debian-Ubuntu)

	usuário: 'postgres'
	senha..: 'sucesso'
	 
	 ***** sudo -u postgres psql template1  - conectar aqui no meu notebook

	psql nome_banco -U usuario  -h 192.168.1.xx --> conectar ao postgres
	psql nome_banco -U postgres -h localhost    --> conectar ao postgres  ( Parâmetros:  -U :: para informar o nome do usuário
	                                                                                     -h :: para informar o host ( IP ou nome do host )
	drop database nome_banco;                   --> excluir um db
	SHOW client_encoding;                       --> mostrar encoding do bd

	Dentro do postgres:
	update pg_database set encoding = pg_char_to_encoding('LATIN1');

	createdb -U usuario -h 192.168.1.xx -E LATIN1 nome_banco;  --> criar um db       - na console do linux
	pg_dump nome_banco -U usuario -h 192.168.1.xx  > saida.out --> criar um dump     - na console do linux
	psql nome_banco -U usuario -h 192.168.1.xx < saida.out     --> restaurar um dump - na console do linux
	 
	sudo /etc/init.d/postgresql restart --> reinicia o postgres     
	sudo service apache2 restart        --> reinicia o postgres
	sudo /etc/init.d/postgresql status  --> mostra status do postgres
	pgAdminIII                          --> ferramenta gráfica do postgres

	--- comandos úteis ---
	\q             --> sair do psql
	\d             --> lista as tabelas do banco de dados
	\d nome_tabela --> mostra a estrutura da tabela
	\df            --> lista as functions do banco de dados
	\l             --> lista os bancos de dados
	\dg            --> lista as roles existentes (usuários ou grupos)
	\conninfo      --> apresenta informações sobre a conexão atual
	\h             --> lista os comandos SQL
	\h comando     --> apresenta detalhes sobre o comando
	\timing        --> mostra o tempo do select ou update

	analyze        --> refaz os indices do banco ( recuperei a performance de um banco de 8gb )

	Formatação
	  \a               --> alterna entre modo de saída desalinhado e alinhado 
	  \f [TEXTO]       --> mostra ou define separador de campos para saída de consulta desalinhada
	  \H               --> alterna para modo de saída em HTML (atual desabilitado)  
	  \t [on|off]      --> mostra somente registros (atual desabilitado)  
	  \x [on|off|auto] --> alterna para saída expandida ( atual desabilitado )

	Copy ( Select * From mda_divida limit 3) To '/tmp/teste.csv' With header CSV; --> faz o select e grava no arquivo: teste.csv



--------------------------- LANGUAGE SQL: ----------------------------------------------------

	ALTER TABLE nome_tabela ADD COLUMN nome_colunda integer NOT NULL;



--------------------------- LINUX: ----------------------------------------------------

	pwd                                             --> (print working directory) - imprime o nome do diretório local 
	ifconfig                                        --> exibir o IP da maquina
	passwd                                          --> Mudar a senha de usuário pelo terminal linux
	tail -f /var/log/apache2/branch_error.log       --> tail pode ser utilizado para examinar as últimas linhas de um arquivo
	sudo apt-get install nome_pacote                --> instalar pacotes
	sudo chmod -R 777 /var/www                      --> alterar permissões de arquivos e diretórios
	mkdir pasta                                     --> criar pasta
	/dados/home/moises$  ln -s projeto_mca/src mca  --> criar link simbólico
	sudo find -name '*.txt' > saida.txt             --> procura arquivos com extensão .txt e grava no arquivo saida.txt
	grep -i "texto a procurar" *.php > saida.txt    --> procurar por palavras ou texto --> -i ignora case sensitive
	date                                            --> exibe data 
	cal                                             --> exibe calendário
	df                                              --> mostra partições
	touch nome_arquivo.txt                          --> Cria o arquivo
	rm nome_arquivo.txt                             --> remove o arquivo
	cat arquivo.txt                                 --> exibir conteudo do arquivo
	cat arquivo.txt | more                          --> exibir conteudo do arquivo => teclar <enter> continua...
	cat arquivo.txt | less                          --> exibir conteudo do arquivo => navegar na tela
	Ls -lha | sort                                  --> exibir ordenado
	ls -lha | sort > teste.txt                      --> exibir ordenado e eviar para arquivo
	ls -lha | sort >> teste.txt                     --> exibir ordenado e eviar para arquivo 'append'
	ls -latr                                        --> listar em ordem de data
	df -h                                           --> exibir o espaço total e quantos GB disponíveis existem em cada partição do sistema
	mcedit                                          --> O editor “mcedit” é um link para o “mc” 
	mcview  /home/moises/limeira_07112015.dump      --> leitor de arquivo ( vantagem: mais rápido )
   gedit                                           --> editor de texto
	ccsm                                            --> gerenciador de configurações do Compiz Config


--------------------------- SUBLIME: TEXT: ----------------------------------------------------

*** SUBLIME: TEXT 3: ***

Ctrl+P                --> procurar arquivos no Projeto
Ctrl+Alt+P            --> Abrir projetos existentes
Ctrl+R                --> procurar métodos no arquivo aberto
Ctrl+G                --> procura pelo numero da linha

Indentação à esquerda --> Ctrl + [    OU  Shift+Tab
Indentação à direita  --> Ctrl + ]    OU  Tab

Ctrl+KU  			    -->  MUDAR PARA MAIÚSCULAS 
Ctrl+kl               -->  mudar para minúsculas 

F2 - Goto Definition  --> ( vai para a classe onde o método  está definido )
Ctrl+SHIFT+K          --> Apagar toda a Linha 

Ctrl+Shift+/          --> para comentar linhas com:  /* */
Ctrl+/                --> para comentar linhas com:  //

Ctrl+Shift+↓          --> move o texto selecionado para baixo
Ctrl+Shift+↑          --> move o texto selecionado para cima
Ctrl+[  			      -->  move o texto selecionado para esquerda
Ctrl+]               -->  move o texto selecionado para direita 

Ctrl+D                --> selecionado o texto de uma coluna ( digite um novo texto )
Alt+F3                --> seleciona um text em todo o arquivo
Shift+setas           --> continua selecionando...

Ctrl+F2               --> marca break point
F2                    --> move entre os break point

Snippets - pequenos trechos de códigos que podem ser reaproveitados durante o desenvolvimento de um projeto
New Snippet           --> criar atalhos para códigos
exemplo:
			<snippet>
				<content><![CDATA[
			print '<pre>'; print_r( ${1:var} ); die( 'parou aqui!!!' ); 
			]]></content>
				<!-- Optional: Set a tabTrigger to define how to trigger the snippet -->
				<tabTrigger>die</tabTrigger>
				<!-- Optional: Set a scope to limit where the snippet will trigger -->
				<!-- <scope>source.python</scope> -->
			</snippet>

    ----> Meu arquivo 'Preferences.sublime-settings'
	{
		"color_scheme": "Packages/Color Scheme - Default/iPlastic.tmTheme",
		"default_encoding": "Western (ISO-8859-1)",
		"detect_indentation": false,
		"font_size": 10,
		"ignored_packages":
		[
			"Vintage"
		],
		"tab_size": 3,
		"translate_tabs_to_spaces": true,
		"word_wrap": "false"
	}

 ----> Meu arquivo 'Key Bindings - User'
[
{ "keys": ["super+d"], "command": "find_under_expand" },
{ "keys": ["ctrl+d"], "command": "duplicate_line" },

{ "keys": ["ctrl+f2"], "command": "next_bookmark" },
{ "keys": ["shift+ctrl+f2"], "command": "prev_bookmark" },
{ "keys": ["f2"], "command": "toggle_bookmark" },
{ "keys": ["ctrl+alt+f2"], "command": "clear_bookmarks" },
{ "keys": ["shift+alt+f2"], "command": "select_all_bookmarks" },
{ "keys": ["ctrl+s"], "command": "save_evernote_note", "context": [{"key": "evernote_note"}] },
{ "keys": ["ctrl+s"], "command": "send_to_evernote", "context": [{"key": "evernote_note", "operator": "equal", "operand": false}, {"key": "selector", "operator": "equal", "operand": "text.html.markdown.evernote"}] },
{ "keys": ["ctrl+t"], "command": "new_file" },
{ "keys": ["ctrl+alt+super"], "command": "alignment" },
{ "keys": ["ctrl+n"], "command": "find_under_expand" },
{ "keys": ["ctrl+k"], "command": "find_under_expand_skip" },

{ "keys": ["super+up"],         "command": "inc_dec_value", "args": { "action": "inc_min" } },
{ "keys": ["super+down"],       "command": "inc_dec_value", "args": { "action": "dec_min" } },
{ "keys": ["ctrl+space"], "command": "toggle_side_bar" },


{ "keys": ["ctrl+up"], "command": "select_lines", "args": {"forward": false} },
{ "keys": ["ctrl+down"], "command": "select_lines", "args": {"forward": true} },

]



-----------------------------------------------------------------------------------------------------------------------------------

*** PHP: ***

--------------------------- instalar e configurar o PHP -------------------------------

sudo apt-get install mysql-server apache2 libapache2-mod-php5 php5 php5-mysql phpmyadmin --> instalar mysql, apache, php e phpmyadmin
sudo cp -R /usr/share/phpmyadmin /var/www                                                --> Copie a pasta /usr/share/phpmyadmin/ com todos os seus subdiretórios para dentro da pasta /var/www/
sudo apt-get install php5-curl                 --> instalar o curl
http://localhost/phpmyadmin/                   --> executar o phpmyadmin  - usuario: root senha: s..
sudo gedit /etc/php5/apache2/php.ini           -- editar o php.ini

--------------------------- criar um virtual host: -----------------------------------------------

   //.. criar 
   /etc/apache2/sites-available$ sudo mcedit sistema_laravel.conf

	<VirtualHost *:80>
		ServerAdmin moinunes@sistema_laravel.com
		ServerName sistema_laravel.com
		ServerAlias www.sistema_laravel.com
		DocumentRoot /var/www/sistema_laravel/public/

		ErrorLog ${APACHE_LOG_DIR}/error.log
		CustomLog ${APACHE_LOG_DIR}/access.log combined

		<directory /var/www/sistema_laravel/public >
			DirectoryIndex index.php
		 	AllowOverride ALL
		</directory>

	</VirtualHost>

	sudo gedit /etc/hosts                          --> incluir no arquivo hosts
	/etc/apache2/sites-available                   --> pasta para configurar os "virtual hosts"
	/etc/apache2/sites-available$/000-default.conf --> virtual host '000-default.conf'
	/etc/apache2/sites-available$/testes.conf      --> virtual host 'tsistema_laravel.conf'
	sudo a2ensite testes                           --> habilitar o Virtual-Host
	sudo /etc/init.d/apache2 restart               --> depois reiniciar o apache

--------------------------- php.ini ----------------------------------------------------

sudo gedit /etc/php5/apache2/php.ini  --> editar o php.ini
display_errors = On                   --> mostrar erros no browser
memory_limit   = 128M                 --> qtd máxima de memória em bytes que um script está permitido alocar
										  para não ter limite de memória, defina esta diretiva para -1.
upload_max_filesize = 2M              --> O tamanho máximo de um arquivo enviado ( upload )

--------------------------- comandos e funções ----------------------------------------

print phpinfo();  --> exibe informações do php

//.. debug_backtrace — Generates a backtrace ( mostra o arquio e alinha que fez a chamada )
$bt = debug_backtrace();
print "<pre>"; 
print_r($totais);
print "\n -> " . $bt[0]["line"] . ": " . $bt[0]["file"] ;
print "</pre>"


--------------------------- APACHE: ---------------------------------------------------------------------------

tail -f /var/log/apache2/branch_hosterror.log      --> mostrar erros do apache
sudo chgrp -hR www-data /var/www/nomedosite    --> mudar o grupo do diretório para www-data, que é o usuário padrão do Apache2.
sudo chown -hR www-data /var/www/nomedosite    --> mudar o dono  do diretório para www-data, que é o usuário padrão do Apache2.
sudo a2enmod rewrite                           --> Habilitar mod_rewrite no Apache (  “URL’s amigáveis“ )
sudo /etc/init.d/apache2 restart --> e depois reiniciar o apache

--------------------------- MYSQL: ----------------------------------------------------------------------------

// reiniciar mysql
sudo service mysql start

// logar
mysql -u root -p

// criar um banco de dados
CREATE DATABASE nome_banco;

// listar os bancos
SHOW DATABASES;

// selecionar o banco
USE nome_banco;

// criar dump ( ubuntu-terminal )
 mysqldump -u root -p estoque_laravel > /home/moinunes/Downloads/dump.sql;

// restaurar dump ( ubuntu-terminal )
mysql -u root -p nome_banco < /home/moinunes/Downloads/dump.sql;


--------------------------- WORDPRESS: ----------------------------------------



--------------------------- GIT: ----------------------------------------

git config --global user.email "moinunes@gmail.com"           --> configurar git
git config --global user.name "moinunes"                      --> configurar git
git remote add origin https://github.com/moinunes/CakePhp.git --> setar url ( setar o origim com o endereço do gitHub )
 
------> comandos repositório local
git init                         --> iniciar o controle de versionamento na pasta atual
git status                       --> ver o status
git add *.php                    --> adicionar arquivos
git add *                        --> adicionar arquivos
git add .                        --> adicionar arquivos
git rm /pasta/arquivo            --> remover arquivos
git commit -m "commit inicial"   --> commit
git add -u                       --> “-u .”, adiciona os arquivos que você apagou do seu projeto no stage, ou seja, é como se você estivesse executando um  “git rm [arquivo]“ automaticamente para cada arquivo apagado.

------------------ comandos repositório remoto
git push -u origin master        --> subir os arquivos para o gitHub



--------------------------- BITBUCKET: -------------------------------------------------------------------

- Utilizando o site bitbucket.org 


--------------------------- zend framework 2: ou zf2: ------------------------------------------------

	-------> Alternativa para instalar o ZF2
	cd /var/www/
	php composer.phar create-project zendframework/skeleton-application --prefer-dist	
	cd skeleton-application
	php composer.phar self-update
	php composer.phar install

	-------> Instalar o ZFTool
	-------> ZFTool – Ferramenta que auxilia na criação de estruturas de um projeto em ZF2.
	a) execute na console --> 'php composer.phar require zendframework/zftool:dev-master'
	b) edite 'config/application.config.php' e acrescente 'ZFTool'
	'modules' => array(
        'Application',
        'ZFTool',
    ),


---------------------------- apache: --------------------------------------------------------

RewriteCond - Voce deve usar a diretiva para adicionar condições para aplicar ou não o redirecionamento.
	

---------------------------- codeigniter: --------------------------------------------------------

    -------> criando e configurando arquivo: '.htacces'
	RewriteEngine on
	RewriteCond $1 !^(index.php|imagens|assets|robots.txt)
	RewriteRule ^(.*)$ /index.php/$1 [L]



--------------------------- PHP: ---------------------------------------------------------------------

	-------> REST FULL: ou REST:
	Fábio Vedovelli        --> https://www.youtube.com/watch?v=u6a1G7LpWFU#t=652
	Postman - REST Client  --> É um plugin do Google Chrome para fazer testes em clientes REST
        
	chrome-extension://fdmmgilgnpjigdojojpjoooidkmcomcm/index.html




--------------------------- LARAVEL: ---------------------------------------------------------------------

	-------> passos para Instalar laravel 5 

	sudo apt-get install php5-curl                         --> cURL é uma biblioteca para obter arquivos de servidor FTP, GOPHER e HTTP.
	sudo curl -sS https://getcomposer.org/installer | php  --> usando o cURL para fazer download e instalação do composer
	sudo mv composer.phar /usr/local/bin/composer          --> mover Composer em uma pasta de acesso global
	cd /var/www                                            --> local para instalar o laravel
	sudo composer create-project --prefer-dist laravel/laravel /var/www/Nome_do_meu_projeto --> usar composer para baixar a ultima versão do laravel
   
   a) sudo a2enmod rewrite                           --> Habilitar mod_rewrite no Apache (  “URL’s amigáveis“ )
   b) sudo chgrp -hR www-data /var/www/nomedosite    --> mudar o grupo do diretório para www-data, que é o usuário padrão do Apache2.
   c) sudo chown -hR www-data /var/www/nomedosite    --> mudar o dono  do diretório para www-data, que é o usuário padrão do Apache2.
   d) sudo /etc/init.d/apache2 restart --> e depois reiniciar o apache

	// se quiser instalar : laravelcollective
   composer update 
   composer require laravelcollective/html

   ------->  Criando o sistema de Login no Laravel 5.2
   php artisan make:auth

	-------> algumas configurações 
	
	sudo chmod -R 777 /var/www/sistema_laravel/storage/  --> permissão total a pasta /storage
	sudo composer require "illuminate/html":"5.0.*"      --> Atualizar o laravel 5 com composer
	config/local/database.php                            --> pasta para criar conexão LOCAL com o DB

	-------> Artisan

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

	
	-------> pastas
	
	/var/www               --> minha pasta web no linux
	/storage/logs/         --> pasta dos logs
	
	
	/var/www/sistema_laravel$ sudo composer dump-autoload --> rodar o comando na console para carregar as bibliotecas acima

	
	-------> configur .env	
	.env  --> arquivo de configurações ( banco de dados e email )


   http://www.vedovelli.com.br
	







	
