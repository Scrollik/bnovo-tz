# API для CRUD операций над гостем

## Для локального запуска
1. Выполните команду из корня: `cd docker`
2. `docker compose up -d`
3. `docker exec -it php-fpm bash`
4. `composer install`
5. Скопировать содержимое env.example в .env
6. `php artisan migrate`
7. `php artisan l5-swagger:generate`
8. `php artisan key:generate`


## API-документация 
Доступна по адресу: http://localhost:8876/api/documentation
