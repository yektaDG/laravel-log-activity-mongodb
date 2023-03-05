# laravel-LogActivity-MongoDB
Log activity inside your Laravel app

initializition config :

By default, activities will be saved to the 'yektalog' database in the 'log' collection if no MongoDB configurations are set in the '.env' or 'config/database.php' files. To change the database to your custom one, add the following lines to the '.env' file in your Laravel application :

MONGODB_CONNECTION=mongodb
MONGODB_HOST=myhost
MONGODB_PORT=27017
MONGODB_DATABASE=yourdatabase

installation :

1. remove 'composer.lock' file and 'vendor' folder
2. run 'composer install' command
3. run 'composer require yektadg/laravel-log-activity-mongodb' command