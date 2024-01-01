
# API de Usuários com Permissões e Autenticação usando Laravel 10 e PHP 8.2. 

### Requisitos
1- Ter o Docker instalado.
2- Ter uma Plataforma de Desenvolvimento de API (Swagger/OpenAPI, Postman, Insomnia, etc.)

### Passo a passo
Clone Repositório
```sh
git clone -b https://github.com/AntonioSebastiaoPedro/laravel-acl.git
```
```sh
cd laravel-acl
```


Crie o Arquivo .env
```sh
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=LaravelACL
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=nome_usuario
DB_PASSWORD=senha_aqui

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```


Suba os containers do projeto
```sh
docker-compose up -d
```


Acesse o container app
```sh
docker-compose exec app bash
```


Instale as dependências do projeto
```sh
composer install
```


Gere a key do projeto Laravel
```sh
php artisan key:generate
```


Acesse a Plataforma de Desenvolvimento de API

Link base da API [http://localhost:8989](http://localhost:8989)