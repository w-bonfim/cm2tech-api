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


Controle das Rotas

app_appbankaccount_index        GET      ANY      ANY    /user/{id}/bank_account
app_appbankaccount_showbank     GET      ANY      ANY    /user/{user_id}/bank_account/{bank_id}
app_appbankaccount_savebank     POST     ANY      ANY    /user/{user_id}/bank_account
app_appbankaccount_updatebank   POST     ANY      ANY    /user/{user_id}/bank_account/{bank_id}
app_appbankaccount_delete       DELETE   ANY      ANY    /user/{user_id}/bank_account/{bank_id}
app_appbank_index               GET      ANY      ANY    /bank/
app_appbank_show                GET      ANY      ANY    /bank/{id}
app_appuser_index               GET      ANY      ANY    /user/
app_appuser_show                GET      ANY      ANY    /user/{id}
app_appuser_save                POST     ANY      ANY    /user/save
app_appuser_update              PUT      ANY      ANY    /user/update
app_appuser_delete              DELETE   ANY      ANY    /user/{id}


OBS: As rotas de salvar e atualizar o Usuário modifiquei para resolver um pequeno problema ("/user/save" e "/user/update")