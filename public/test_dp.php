<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
//
use App\Config\Database;
use App\Utils\HelloWorld;

$hello = new HelloWorld();
echo $hello->sayHello();



try {
    $db = Database::getInstance();
    echo "Database connection successful!";
} catch (\Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}



