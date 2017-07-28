TESTE CONVENIA (Lumen 5.2)
========================


O que é isso?
-------------

API Restfull do teste de PHP Pleno Convenia


Instalação
----------

1.  Instale o [Composer](https://getcomposer.org/). Depois digite no terminal
    `composer install`. Se tiver problemas, consulte as [instruções de
    instalação do Lumen 5.2](https://lumen.laravel.com/docs/5.2)
2.  Copie o arquivo `.env.example` para `.env` e edite os dados de acesso ao
    banco e servidor de _e-mail_. Para o parâmetro key, crie uma randon string de 32 caracteres.
3.  Digite no terminal `php artisan migrate --seed`, e para todas as questões
    responda `yes`. Confira no arquivo `database/seeds/UserTableSeeder.php`, os acessos de usuários.

Em ambiente de produção altere no arquivo `.env` a configuração `APP_DEBUG`
para `false`, e mude a senha padrão, por segurança.


Estrutura do diretório
----------------------

Os diretórios `app/`, `resources/views/` e, `app/Http/Controllers/` contêm o
código no padrão _Model-View-Controller_ (MVC), e o arquivo
`routes/web.php` contém as rotas. O diretório `vendor/` contém os
arquivos de terceiros, e o diretório `public/` contém a raiz do _website_.

Design Patterns
---------------
Utilizamos dois Design Patterns neste projeto, o `Repository` e o de `Services`.

Para desenvolvimento de funções com persistência de dados, crie um novo Repository (acompanhe os modelos já aqui pré-desenvolvidos). Você também pode reaproveitar várias funções prontas na classe `RepositoryInterface`.

O Pattern de Services, foi aplicado para dividir as funções oferecidas pela API por camadas lógicas. Sendo assim, todo o tratamento dos dados deve ser feito dentro de um serviço, na pasta `app/Http/Services`, e o retorno disto, deve ser feito dentro de um Controller. Acompanhe os códigos pré-desenvolvidos para ter uma noção do desenvolvimento de novas funções.
