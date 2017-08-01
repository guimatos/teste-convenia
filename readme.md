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
3.  Digite no terminal `php artisan migrate` para criar todas as tabelas necessárias ao projeto.

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


ENDPOINTS
---------------

Todos os retornos são em formato json

> Criar vendedor:
/sellers
##### Método
- POST

##### Parâmetros
- name (Requerido|String)
- email (Requerido|Email)

---

> Listar todos os vendedores:
/sellers
##### Método
- GET

---

> Lançar nova venda para um vendedor:
/sellers/{sellerId}/sale
##### Método
- POST

##### Parâmetros
- amount (Requerido|Number)

---

> Listar todas as vendas de um vendedor:
/sellers/{sellerId}/sale

##### Parâmetros
- sellerId: ID vendedor

Uma cópia da coleção do "Postman" com todas as rotas, bem como seus parâmetros e métodos pode ser encontrada neste link: https://www.getpostman.com/collections/89bbeb3a98d2f25f54cf.

COMANDOS
---------------

##### Emails com resumo de vendas
A API está configurada para enviar os emails com o resumo das vendas aos vendedores ao final do dia, basta editar o seu arquivo cronjob com o seguinte parâmtero: `* * * * * php /Users/usuario/Projects/teste.convenia.dev/artisan schedule:run >> /dev/null 2>&1`.

Entretanto, você pode enviar estes emails no momento em que desejar, basta digitar no terminal o comando `php artisan email:salesresume`, e iniciar a execução da fila no Laravel, utilizando o comando `php artisan queue:listen`.

##### Testes Unitários
Para executar os testes unitarios, execute o comando `php vendor/phpunit/phpunit/phpunit tests/SellerTest`.


