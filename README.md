<h1 align="center">MINI POS MAJOO</h1>
<p align="center">by abdan syakuro</p>

## Install

- Clone from git repository
```
git clone https://github.com/abdansya/testcase-pos-majoo.git
```
- Copy .env.example to .env and adjust the value
- Composer install
```
composer install
```
- Run generate key
```
php artisan key:generate
```
- Run storage link
```
php artisan storage:link
```
- Run migration and seeder
```
php artisan migrate --seed
```
- Run server in localhost
```
php artisan serve
```

You can login to dashboard admin with path `http://localhost:8000/login` and user email `admin@email.com` and password `password123`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
