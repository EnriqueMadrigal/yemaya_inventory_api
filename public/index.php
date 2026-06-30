<?php
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';



use App\Utils\HelloWorld;
use App\Routing\Router;
use App\Controllers\LoginController;
use App\Services\UserService;
use App\Repositories\UserRepository;
use App\Controllers\AuthController;
use App\Services\AuthService;
use App\Controllers\UserController;
use App\Middleware\AuthMiddleware;
use App\Middleware\ApiKeyMiddleware;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
 $dotenv->load();

$router = new Router();

$userRepository = new UserRepository();


$loginController = new LoginController(new UserService($userRepository));
$authController = new AuthController(new AuthService($userRepository));
$userController = new UserController(new UserService($userRepository));
$authMiddleware = new AuthMiddleware(new AuthService($userRepository));
// Define a test route
$router->get('/api/test', function () {
    //return ("OK");
     http_response_code(200);
     //retun json_encode(['message' => 'Welcome to the Task Management API!']);
    echo json_encode(['message' => 'Welcome to the Task Management API!']);
});


//$router->post('/api/login', function() {

$router->post('/api/login', fn() => $authController->Login());
$router->post('/api/register', fn() => $loginController->register());
$router->post('/api/register', fn() => $loginController->register());
$router->get('/api/user/(\d+)', fn($id) => $userController->getById($id),[AuthMiddleware::class]);




$router->dispatch();



?>
