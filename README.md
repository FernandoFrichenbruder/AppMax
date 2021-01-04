# AppMax
### CRUD Laravel para Produtos, Estoque, Pedidos e Relatórios

##### Para instalar o projeto você vai precisar do [Composer][https://getcomposer.org/download/], o Laravel Installer e uma base de dados MySQL
##### Com o composer instalado: 

```
composer global require laravel/installer

git clone https://github.com/FernandoFrichenbruder/AppMax.git

cd appmax

composer install

npm run dev
```

### Crie uma base de dados e edite o arqivo .env na raiz do projeto
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=appmax
DB_USERNAME=root
DB_PASSWORD=
```

### Com a base de dados conectada corretamente, rode as migrations e seeders
```
php artisan migrate --seed
```

### Pronto! Agora você pode rodar o projeto e acessá-lo
```
php artisan serve
```
