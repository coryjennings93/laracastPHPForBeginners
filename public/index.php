<?php



use Core\Session;
use Core\ValidationException;



// if you want to use $_SESSION superglobal, you have to start session
session_start();

const BASE_PATH = __DIR__ . '/../';

// cannot use base_path helper function because it is defined in the functions.php file; this imports the functions file into the project globally
require BASE_PATH . 'Core/functions.php';

// callback that will automatically load a class when it is called in the program when they are not manually included
spl_autoload_register(function ($class) {

    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require base_path("{$class}.php");
});

require base_path('bootstrap.php');

// initialize router class
$router = new \Core\Router();

$routes = require base_path('routes.php');
// rip off a query string.. breaks URL into ass array of URL components
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];



// perform the routing
// moved try catch from the session store controller by bubbling the logic up
try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {

    // runs if password validation failed
    Session::flash('errors', $exception->getErrors());

    // flash the old form data to load if there was an error
    Session::flash('old', $exception->getOld());

    return redirect($router->previousUrl());
}

// clear out any flashed session data
Session::unflash();



// $config = require base_path('config.php');




// try {
//     $db = new Database($config['database']);
//     $posts = $db->query("SELECT * FROM posts")->getQueryResults();


//     foreach ($posts as $post) {
//         echo "<li>" . $post['title'] . "</li>";
//     }
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }
