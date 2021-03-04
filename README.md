<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

### 請先安裝網銀
- https://github.com/sm0414/Internet-banking
#
### 下載後請依序執行
    $ docker-compose up -d --build
    $ composer install
    $ cp .env.example .env

- **.env 修改成以下**
> DB_CONNECTION=mysql
> 
> DB_HOST=store_mysql-container
> 
> DB_PORT=3306
> 
> DB_DATABASE=store
> 
> DB_USERNAME=root
> 
> DB_PASSWORD=root

    $ docker exec -it store_php74-container bash -c "php artisan key:generate && php artisan migrate && chmod 777 -R storage"
