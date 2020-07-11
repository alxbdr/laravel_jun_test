Laravel junior test project

Installation

git clone git@github.com:alxbdr/laravel_jun_test.git
or
git clone https://github.com/alxbdr/laravel_jun_test.git

cd laravel_jun_test
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate

Create database and user than set DB settings in .env file:
CREATE DATABASE laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
GRANT ALL PRIVILEGES ON laravel.\* TO 'laravel'@'localhost' IDENTIFIED BY 'laravel' WITH GRANT OPTION;

Run migration and seeding:
php artisan migrate
php artisan db:seed

Start application:
php artisan serve

Test user:
username: test
email: test@email.com
password: test1234
