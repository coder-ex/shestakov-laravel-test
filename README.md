### ТЗ тестовой работы
    ИП ШЕСТАКОВ АЛЕКСАНДР ВЛАДИМИРОВИЧ
    https://startup-it.ru/

### стек разработки
    docker + docker-compose + nginx + php-fpm + postgres + pgadmin

### предустановленные пакеты
    nginx
    postgres (PostgreSQL) 14.3 (Debian 14.3-1.pgdg110+1)
    pgadmin
    php v8.1.6
    imagick 3.7.0
    xdebug 3.1.4

---
### установка проекта
* docker-compose up -d --build
* docker exec -it php-fpm /bin/bash

---
### необходимые конфигурации проекта Laravel 9.x
* composer create-project --prefer-dist laravel/laravel server
* php artisan migrate
* php artisan db:seed

---
### комментарии по ТЗ
* в ТЗ не указано, но по идее нужно было реализовать аутентификацию и авторизацию
* реализован REST API на back-end
* не реализовывались эндпоинты на удаление по таблицам, это стандартные операции
* не реализовывалось натягивание верстки на front-end
* по остальным пунктам ТЗ все реализовано
* выгрузка эндпоинтов для Postman, находится в каталоге collection

---
