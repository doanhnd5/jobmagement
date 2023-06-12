## Chạy project trên server ubuntu
1. Cài nodejs 
2. Cài npm
 - sudo apt install nodejs npm

 cài pm2 để quản lý terminal 
 - npm install pm2 -g

3. Chạy dự án bằng pm2 
  - pm2 start artisan --name "job-visa" --interpreter php -- serve --host=0.0.0.0 --port=8000

1. Môi trường
 - Cài đặt PHP 8.2
 - Cài đặt composer
 - MySQL
2. Chạy commomand
 - composer install
 - php artisan migrate:fresh 
 - php artisan db:seed
3. Run
 - php artisan serve

php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear