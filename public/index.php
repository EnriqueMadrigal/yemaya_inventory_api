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
use App\Controllers\FamiliaController;
use App\Controllers\UbicacionController;
use App\Controllers\MarcaController;
use App\Controllers\MovimientoController;


//use App\Entities\Paciente;



use App\Services\UserService;
use App\Services\AuthService;
use App\Services\ComponentsTextService;
use App\Services\UnidadBasicaService;
use App\Services\UnidadMedidaService;
use App\Services\ArticuloService;
use App\Services\FamiliaService;
use App\Services\UbicacionService;
use App\Services\MarcaService;
use App\Services\MovimientoService;



use App\Repositories\UserRepository;
use App\Repositories\ComponentsTextRepository;
use App\Repositories\UnidadBasicaRepository;
use App\Repositories\UnidadMedidaRepository;
use App\Repositories\ArticuloRepository;
use App\Repositories\FamiliaRepository;
use App\Repositories\UbicacionRepository;
use App\Repositories\MarcaRepository;
use App\Repositories\MovimientoRepository;


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
$familiaRepository = new FamiliaRepository();
$ubicacionRepository = new UbicacionRepository();
$marcaRepository = new MarcaRepository();
$movimientoRepository = new MovimientoRepository();



$loginController = new LoginController(new UserService($userRepository));
$authController = new AuthController(new AuthService($userRepository));
$userController = new UserController(new UserService($userRepository));
$componentsTextController = new ComponentsTextController(new ComponentsTextService($componentsTextRepository));
$unidadBasicaController = new UnidadBasicaController(new UnidadBasicaService($unidadBasicaRepository));
$unidadMedidaController = new UnidadMedidaController(new UnidadMedidaService($unidadMedidadRepository));
$articleController = new ArticuloController(new ArticuloService($articleRepository));
$familiaController = new FamiliaController(new FamiliaService($familiaRepository));
$ubicacionController = new UbicacionController(new UbicacionService($ubicacionRepository));
$marcaController = new MarcaController(new MarcaService($marcaRepository));
$movimientoController = new MovimientoController(new MovimientoService($movimientoRepository));

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


//Ubicacion
$router->post('/api/ubicacion/', fn() => $ubicacionController->insert(),[AuthMiddleware::class]);
$router->get('/api/ubicacion/', fn() => $ubicacionController->getAll(),[AuthMiddleware::class]);
$router->get('/api/ubicacion/(\d+)', fn($id) => $ubicacionController->getById($id),[AuthMiddleware::class]);
$router->put('/api/ubicacion/', fn() => $ubicacionController->update(),[AuthMiddleware::class]);

//Familia
$router->post('/api/familia/', fn() => $familiaController->insert(),[AuthMiddleware::class]);
$router->get('/api/familia/', fn() => $familiaController->getAll(),[AuthMiddleware::class]);
$router->get('/api/familia/(\d+)', fn($id) => $familiaController->getById($id),[AuthMiddleware::class]);
$router->put('/api/familia/', fn() => $familiaController->update(),[AuthMiddleware::class]);

//marca
$router->post('/api/marca/', fn() => $marcaController->insert(),[AuthMiddleware::class]);
$router->get('/api/marca/', fn() => $marcaController->getAll(),[AuthMiddleware::class]);
$router->get('/api/marca/(\d+)', fn($id) => $marcaController->getById($id),[AuthMiddleware::class]);
$router->put('/api/marca/', fn() => $marcaController->update(),[AuthMiddleware::class]);


//movimiento
$router->post('/api/movimiento/', fn() => $movimientoController->insert(),[AuthMiddleware::class]);
$router->get('/api/movimiento/', fn() => $movimientoController->getAll(),[AuthMiddleware::class]);
$router->get('/api/movimiento/(\d+)', fn($id) => $movimientoController->getById($id),[AuthMiddleware::class]);



$router->dispatch();



?>
