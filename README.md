# API для CRUD операций над гостем

## Для локального запуска
1. Скопировать содержимое env.example в .env
2. `cd docker`
3. `docker compose up -d`
4. `docker exec -it php-fpm bash`
5. `composer install`
6. `php artisan migrate`
7. `php artisan l5-swagger:generate`
8. `php artisan key:generate`


## API-документация 
Доступна по адресу: http://localhost:8876/api/documentation
