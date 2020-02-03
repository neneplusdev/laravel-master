# laravel-master
This project contains simple login, registration and CRUD operation in Laravel 5.8. Having implemented data-table also.

# Steps to setup the project.

* Clone the repository.
- https://github.com/neneplusdev/laravel-master.git / git@github.com:neneplusdev/laravel-master.git

* Go to the project folder and install the composer using below command
- composer install

* Set the debug mode true inside app.php file to see the error

* Give the permission to storage & bootstrap folder if require

* copy .env.example file in .env file and change the database credential

* Generate encryption key if require

* Run the migration using command: php artisan migrate

* Run the seeder using command: php artisan db:seed --class=UsersTableSeeder

* Run the project using: php artisan serve --port=8080

* Run the URL in browser http://localhost:8080

* You can also setup the virtual host to run the project.
