Informações técnica

- PHP 7.0
- Mysql 5.7
- Framework Symfony 3.4

Instruções de Instalação

Siga a sequência: 

1- Execute o comando abaixo na raiz do projeto 

composer install

2- Duplique o arquivo "parameters.yml.dist" e renomeie para "parameters.yml" e adicione as informações do banco de dado

3- Para criar e manipular o banco de dados execute os comandos abaixo

php app/console doctrine:database:create

php app/console doctrine:schema:create

php app/console doctrine:fixtures:load

4 - Rodar o projeto 

php bin/console server:run 

Exemplo de como ficou as rotas da API
http://127.0.0.1:8000/api/user

 
