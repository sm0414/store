# <p align="center">網路商城</p>

使用Laravel框架完成，搭配網銀系統使用，結帳前記得先到網銀進行存款~

port: 8000

> 登入管端帳密，對商品進行管理
>- E-Mail Address: admin@gmail.com
>- Password: 12345678
 
### 請先安裝網銀並run起來
- https://github.com/sm0414/Internet-banking
#
### 下載後請依序執行
    $ docker-compose up -d --build
    $ docker exec -it store_php74-container bash -c "composer install"
    $ docker exec -it store_php74-container bash -c "php artisan key:generate && php artisan migrate && chmod 777 -R storage && php artisan storage:link"
    $ docker exec -it store_php74-container bash -c "php artisan DB:seed"
