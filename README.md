Laravel junior test project


<br>
php 7.3
npm
composer

<br><br>
Installation

git clone git@github.com:alxbdr/laravel_jun_test.git <br>
or <br>
git clone https://github.com/alxbdr/laravel_jun_test.git

cd laravel_jun_test <br>
composer install <br>
npm install && npm run dev <br>
cp .env.example .env <br>
php artisan key:generate <br> <br>

Create database and user than set DB settings in .env file:<br>
CREATE DATABASE laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;<br>
GRANT ALL PRIVILEGES ON laravel.\* TO 'laravel'@'localhost' IDENTIFIED BY 'laravel' WITH GRANT OPTION;<br>
<br><br>
Run migration and seeding:<br>
php artisan migrate<br>
php artisan db:seed<br>
<br>
Start application:<br>
php artisan serve<br>
<br><br>
Test user:<br>
username: test<br>
email: test@email.com<br>
password: test1234<br>
