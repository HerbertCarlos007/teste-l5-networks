<?php
require_once("config/Database.php");
require_once("App/Controller/MovieController.php");

use App\Controller\MovieController;

$con = Database::getConection();
$movieController = new MovieController();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization"); 
header("Access-Control-Allow-Credentials: true"); 


if (strpos($_SERVER['REQUEST_URI'], '/backend/index.php/movies') !== false && $_SERVER['REQUEST_METHOD'] === 'GET' && !preg_match('#^/backend/index.php/movies/(\d+)$#', $_SERVER['REQUEST_URI'])) {
    $movies = $movieController->fetchAndSaveMovies();
} 

elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && preg_match('#^/backend/index.php/movies/(\d+)$#', $_SERVER['REQUEST_URI'], $matches)) {
    $id = intval($matches[1]);
    $movieController->getMovieById($id);
} else {
    error_log("URL ou método da requisição incorretos.");
}
?>
