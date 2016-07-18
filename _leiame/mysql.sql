/*------------------------------------------------------------------------------------------------------  
*
*  arquivo..: mysql.sql
*
*  objetivo.: reunir informações sobre o "gerenciador de banco de dados MYSQL"
*
--------------------------------------------------------------------------------------------------------*/



-------------------------------------------------------------------------------------- comandos básicos
mysql -h NOME-DO-SERVIDOR -u NOME-DO-USUARIO -- conectar
mysql -u root -p                             -- conectar
CREATE DATABASE nome_banco;                  -- criar banco 
SHOW DATABASES;                              -- var os bancos existentes
DROP DATABASE biblioteca;                    -- dropar banco
USE clientes;                                -- usar banco de daos clientes
DESCRIBE clientes;                           -- obtém informações da tabela
DESC     clientes;                           -- obtém informações da tabela
drop table contatos;                         -- DROPAR TABELA

-------------------------------------------------------------------------------------- criar dump
-- dump de todas as bases de dados
mysqldump -u USUARIO -pSENHA -h localhost –all-databases > saida_todos_bancos.sql 
-- dump de de uma bases de dados
mysqldump -u USUARIO -pSENHA -h localhost nome_banco > saida.sql 
-- dump de uma tabela
mysqldump -u USUARIO -pSENHA -h localhost nome_banco –table nome_tabela > saida.sql 
-- –no-data -  faz backup apenas da estrutura
mysqldump -u USUARIO -pSENHA -h localhost –no-data blog > blog.sql                     
-- E para restaurar:
mysql -u USUARIO -pSENHA BASE < ARQUIVO.sql

-------------------------------------------------------------------------------------- usando variáveis
mysql> SET @numero = 3;                                    -- Exemplos de uso de variáveis
mysql> SELECT * FROM clientes WHERE idCliente = @numero;   -- Exemplos de uso de variáveis
mysql> SET @contagem := (SELECT COUNT(*) FROM clientes);   -- Exemplos de uso de variáveis
mysql> select @contagem;                                   -- Exemplos de uso de variáveis

-------------------------------------------------------------------------------------- criar tabelas
-- criar tabela
CREATE TABLE cliente (
   id_cliente     mediumint(8) unsigned NOT NULL auto_increment,
   nome_empresa   varchar(255),
   nome_diretor   varchar(255) default NULL,
   num_empregados mediumint default NULL,
   PRIMARY KEY ('id_cliente')
) AUTO_INCREMENT=1;
-- criar tabela com select
CREATE TABLE minha_tabela_nova SELECT coluna1, coluna2, coluna4 FROM minha_tabela_original;
 -- criar uma nova tabela vazia, com a mesma estrutura da tabela original:
create table tbnova like tboriginal;

-------------------------------------------------------------------------------------- insert, update, delete
INSERT INTO clientes (id_cliente,nome_empresa,nome_diretor,num_empregados) VALUES (1,"Malesuada Inc.","Johnny Pedd",4847);

-------------------------------------------------------------------------------------- criar indices
-- criar indice
create unique index idx_contatos on contatos(nome,sobrenome); 
   -- criar indice 'UNIQUE'
alter table contatosnovo add unique index idx_contatos(nome,sobrenome);

-------------------------------------------------------------------------------------- alterar estrutura DA TABELA
-- renomeia a tabela
alter table contatosnovo rename to contatos; 

-------------------------------------------------------------------------------------- SELECT
-- obter a hora do servidor
SELECT NOW();            
-- obter a data atual
SELECT CURDATE()         
-- LIKE
SELECT nome_projeto FROM projetos WHERE nome_projeto LIKE 'Mo%';
-- CONCAT
SELECT id_projeto, CONCAT('projeto ', nome_projeto, ' iniciado em ', data_inicio_projeto) AS Detalhes, valor_projeto 
FROM projetos WHERE valor_projeto > 3000000;
-- GROUP BY
SELECT COUNT(*) AS Contagem, nome_projeto FROM projetos GROUP BY nome_projeto HAVING Contagem >= 2;
-- DISTINCT
SELECT DISTINCT nome_projeto FROM projetos WHERE nome_projeto = 'Caledon';
-- ROUND e AVG
SELECT ROUND(AVG(valor_projeto),2) as 'Média de valores cobrados' FROM proj
-- SELECT dentro de outro SELECT
SELECT * FROM (SELECT * FROM projetos WHERE valor_projeto > 2700000) AS Tarefas WHERE id_projeto;
-- Resultado do SELECT em um arquivo .txt
SELECT ROUND(AVG(valor_projeto),2) as 'Média de valores cobrados' INTO OUTFILE '/tmp/média_de_valores_cobrados.txt' FROM projetos;
-- Resultado do SELECT em um arquivo .csv
SELECT nome_projeto, valor_projeto INTO OUTFILE '/tmp/valores.csv' FIELDS TERMINATED BY ',' FROM projetos WHERE valor_projeto > 2000000
-- JOIN
SELECT pedidos.*, vendedores.* FROM pedidos INNER JOIN vendedores ON pedidos.vendedor_id = vendedores.id
-- LEFT JOIN
SELECT pedidos.*, vendedores.* FROM pedidos LEFT JOIN vendedores ON pedidos.vendedor_id = vendedores.id
-- RIGHT JOIN
SELECT pedidos.*, vendedores.* FROM pedidos RIGHT JOIN vendedores ON pedidos.vendedor_id = vendedores.id
