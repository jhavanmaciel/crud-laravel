COMO RODAR A APLICAÇÃO

1) executar o comando composer install na pasta

2) editar o arquivo .env e mudar as credenciais de acordo com o seu banco(caso precise de usuario e senha),somente esses dois parâmetros:DB_USERNAME, DB_PASSWORD

3) crie um banco de dados com o nome "crud" e execute o seguinte comando para rodar as migrations

php artisan migrate

3) executar esse comando para utilizar as datatables 

composer require yajra/laravel-datatables-oracle

4) rodar o server com seguinte comando

php artisan serve

5) acessar http://localhost:8000 no seu browser.