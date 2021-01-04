# AppMax
### CRUD Laravel para Produtos, Estoque, Pedidos e Relatórios

##### Para instalar o projeto você vai precisar do [Composer](https://getcomposer.org/download/), o Laravel Installer e uma base de dados MySQL


##### Com o composer instalado: 

```
composer global require laravel/installer

git clone https://github.com/FernandoFrichenbruder/AppMax.git

cd appmax
```
### Crie uma base de dados, renomeie o arquivo .env.example na raiz do projeto para .env e edite a conexão com o DB
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=appmax
DB_USERNAME=root
DB_PASSWORD=
```

### Rode o Composer, gere a chave do Laravel e rode o npm
```
composer install

php artisan key:generate

npm install
```

### Com a base de dados conectada corretamente, rode as migrations e seeders
```
php artisan migrate --seed
```

### Pronto! Agora você pode rodar o projeto e acessá-lo
```
php artisan serve
```

### Ao acessar o projeto em http://127.0.0.1:8000 você poderá fazer o login ou registrar um usuário.
### Por comodidade, já existe um usuário cadastrado! 
- e-mail: fernando.frich@gmail.com
- senha: password
### Ou você pode criar um novo usuário em [register](http://127.0.0.1:8000/register)

### Após logado você será redirecionado para a tela de Produtos e poderá navegar pelo sistema.


# API
### A API está protegida por autenticação, necessidando logar pelo endpoint **http://127.0.0.1:8000/api/login**
### Este endpoint irá retornar o token de autenticação necessário para acessar os outros dois endpoints da aplicação
- **http://127.0.0.1:8000/api/baixar-produtos**
- **http://127.0.0.1:8000/api/remover-produtos**

