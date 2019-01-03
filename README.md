# easyEvent
## ACR 18/19 project
* Joaquim Abreu
* Luciano Franco
* Miguel Andrade
### to run this application you must:
* clone the repository
```
git clone <this repository>
```
* open the folder and run on the terminal
```
composer install
```
* copy .env.example file to .env on the root folder
* open the .env file and change the database name (DB_DATABASE), username (DB_USERNAME) and password (DB_PASSWORD) fields to correspond your configuration (by default the username is root and password is also root)
* Run 
```
php artisan key:generate
```
* Run 
```
php artisan migrate
```
* Run 
```
php artisan passport:install
```
* Run 
```
php artisan serve
```
* The application will start in localhost:8000
