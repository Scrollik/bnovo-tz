# API для CRUD операций над гостем

## Для локального запуска
1. Выполните команду из корня: `cd docker`
2. `docker compose up -d`
3. `docker exec -it php-fpm`
4. `composer install`
5. `php artisan migrate`
6. `php artisan l5-swagger:generate`


## API-документация 
Доступна по адресу: http://localhost:8876/api/documentation
