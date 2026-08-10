<?php
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';



use App\Utils\HelloWorld;
use App\Routing\Router;
use App\Controllers\LoginController;
use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\ComponentsTextController;
use App\Controllers\UnidadBasicaController;
use App\Controllers\UnidadMedidaController;
use App\Controllers\ArticuloController;

//use App\Entities\Paciente;



use App\Services\UserService;
use App\Services\AuthService;
use App\Services\ComponentsTextService;
use App\Services\UnidadBasicaService;
use App\Services\UnidadMedidaService;
use App\Services\ArticuloService;


use App\Repositories\UserRepository;
use App\Repositories\ComponentsTextRepository;
use App\Repositories\UnidadBasicaRepository;
use App\Repositories\UnidadMedidaRepository;
use App\Repositories\ArticuloRepository;

use App\Middleware\AuthMiddleware;
use App\Middleware\ApiKeyMiddleware;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
 $dotenv->load();

$router = new Router();

$userRepository = new UserRepository();
$componentsTextRepository = new ComponentsTextRepository();
$unidadBasicaRepository = new UnidadBasicaRepository();
$unidadMedidadRepository = new UnidadMedidaRepository();
$articleRepository = new ArticuloRepository();

$loginController = new LoginController(new UserService($userRepository));
$authController = new AuthController(new AuthService($userRepository));
$userController = new UserController(new UserService($userRepository));
$componentsTextController = new ComponentsTextController(new ComponentsTextService($componentsTextRepository));
$unidadBasicaController = new UnidadBasicaController(new UnidadBasicaService($unidadBasicaRepository));
$unidadMedidaController = new UnidadMedidaController(new UnidadMedidaService($unidadMedidadRepository));
$articleController = new ArticuloController(new ArticuloService($articleRepository));

$authMiddleware = new AuthMiddleware();


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

//ComponentsText
$router->get('/api/componentsText/(\d+)', fn($id) => $componentsTextController->getByIdProject($id),[AuthMiddleware::class]);

//UnidaBasica
$router->post('/api/unidadbasica/', fn() => $unidadBasicaController->insert(),[AuthMiddleware::class]);
$router->get('/api/unidadbasica/', fn() => $unidadBasicaController->getAll(),[AuthMiddleware::class]);
$router->get('/api/unidadbasica/(\d+)', fn($id) => $unidadBasicaController->getById($id),[AuthMiddleware::class]);
$router->put('/api/unidadbasica/', fn() => $unidadBasicaController->update(),[AuthMiddleware::class]);

//UnidaMedidad
$router->post('/api/unidadmedida/', fn() => $unidadMedidaController->insert(),[AuthMiddleware::class]);
$router->get('/api/unidadmedida/', fn() => $unidadMedidaController->getAll(),[AuthMiddleware::class]);
$router->get('/api/unidadmedida/(\d+)', fn($id) => $unidadMedidaController->getById($id),[AuthMiddleware::class]);
$router->put('/api/unidadmedida/', fn() => $unidadMedidaController->update(),[AuthMiddleware::class]);

//Articulo
$router->post('/api/articulo/', fn() => $articleController->insert(),[AuthMiddleware::class]);
$router->get('/api/articulo/', fn() => $articleController->getAll(),[AuthMiddleware::class]);
$router->get('/api/articulo/(\d+)', fn($id) => $articleController->getById($id),[AuthMiddleware::class]);
$router->put('/api/articulo/', fn() => $articleController->update(),[AuthMiddleware::class]);




$router->dispatch();



?>
