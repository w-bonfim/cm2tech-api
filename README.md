Instruções de Instalação

Siga a sequência: 

1- Execute o comando abaixo na raiz do projeto 

composer install

2- Duplique o arquivo "parameters.yml.dist" e renomeie para "parameters.yml" e adicione as informações do banco de dados da sua maquina

Exemplo:
parameters:
    database_host: 127.0.0.1
    database_port: null
    database_name: cm2tech
    database_user: root
    database_password: xxxx
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    secret: 4cf567873ee9fbc2b6b22f23112cdcc5017a2891

3- Para criar e manipular o banco de dados execute os comandos abaixo

php app/console doctrine:database:create

php app/console doctrine:schema:create

php app/console doctrine:fixtures:load

4 - Rodar o projeto 

php bin/console server:run 


Informações técnica

- PHP 7.0
- Mysql 5.7
- Framework Symfony 3.4


