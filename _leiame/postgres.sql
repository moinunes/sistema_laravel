/*------------------------------------------------------------------------------------------------------  
*
*  arquivo..: postgres.sql
*
*  objetivo.: reunir informações sobre o "gerenciador de banco de dados POSTGRES"
*
--------------------------------------------------------------------------------------------------------*/


-------------------------------------------------------------------------------------- conectar
-- A instalação do PostgreSQL não dá nenhuma oportunidade de criar a senha do usuário "postgres", 
--                                                       sendo assim, o comando abaixo resolverá: 
sudo -u postgres psql                               -- entra na console do postgres
alter user postgres with encrypted password 's...'; -- depois mude a senha

usuário: 'postgres'  
senha..: 's...'
-U  -- para informar usuário
-h  -- para informar o host ( IP ou nome do host )
psql template1 -U postgres -h localhost      -- conectar local
psql nome_banco -U usuario -h 192.168.1.xx   -- conectar em outra máquina

-------------------------------------------------------------------------------------- comandos básicos
createdb -U usuario -h 192.168.1.xx -E LATIN1 nome_banco;         --> criar um db       - na console do linux  
drop database nome_banco;                                         --> excluir um db
SHOW client_encoding;                                             --> mostrar encoding do bd
sudo /etc/init.d/postgresql restart                               --> reinicia o postgres
sudo /etc/init.d/postgresql status                                --> mostra status do postgres
service postgresql status                                         --> mostra status do postgres
pgAdminIII                                                        --> ferramenta gráfica do postgres


-------------------------------------------------------------------------------------- dump
pg_dump nome_banco -U usuario -h 192.168.1.xx  > saida.out     --> criar um dump     - na console do linux
psql nome_banco -U usuario -h 192.168.1.xx < saida.out         --> restaurar um dump - na console do linux
    
-------------------------------------------------------------------------------------- comandos úteis
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

-------------------------------------------------------------------------------------- sites úteis
-- corrigir encoding do postgres -> encontrei esse site:
http://www.vivaolinux.com.br/artigo/Encoding-do-Postgres-(latin1)-e-encoding-do-SO-(Debian-Ubuntu)

-------------------------------------------------------------------------------------- encoding

-- para poder usar latin1
-- seguir o passo a passo desse site:
https://www.vivaolinux.com.br/dica/Reconfigurar-as-LOCALES-passando-de-UTF8-para-ISO88591

-- 6) execute abaixo:
    chown postgres.postgres /var/run/postgresql

-- 7) einicia o postgre
    sudo /etc/init.d/postgresql restart   

sudo -u postgres psql 
update pg_database set encoding = pg_char_to_encoding('LATIN1');  --> mudar o encoding
update pg_database set encoding = pg_char_to_encoding('UTF8') where datname = 'teste' --> mudar o encoding


-------------------------------------------------------------------------------------- LANGUAGE SQL

-- faz COPY PARA arquivo: teste.csv
Copy ( Select * From mda_divida limit 3) To '/tmp/teste.csv' With header CSV; 

