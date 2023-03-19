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
4. in each models that want to log it's activity you shuld add the following options :
- add YektaLog trait like this : 
        
        class Test extends Model
            {
                use YektaLog;
                ....
            }

- Add a 'protected $foreignKeys' array to your model like this:
    
    protected $foreignKeys = 
    [
        'App\Models\Ticket' => 'ticket_id', 
        'App\Models\User' => 'user_id',
    ]

    'ticket_id' and 'user_id' are the referenced fields in this model, and 'App\Models\Ticket' and 'App\Models\User' are their corresponding classes.

- Add a 'getForeignKeys()' method to your model that returns the 'foreignKeys' variable:
    
    public function getForeignKeys(){
            return $this->foreignKeys;
        }

    This method will allow you to retrieve the 'foreignKeys' array.

- Add a 'getShowRoute()' method to your model that returns a route name. this route will saved in database and You can use this method in your views to create a link to the logged object:

    public function getShowRoute(){
        return "test.show";
    }

    if you don't need this route, return an empty srting like this:

    public function getShowRoute(){
        return "";
    }
    
* Use 'Yektadg\LaravelLogActivityMongodb\Models\Log' to access the Log Model like bellow :
    
use Yektadg\LaravelLogActivityMongodb\Models\Log;
$logs = Log::where('created_at' ,'!=', null);
