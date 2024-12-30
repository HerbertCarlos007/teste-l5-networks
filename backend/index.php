<?php
require_once("config/Database.php");
require_once("App/Controller/MovieController.php");
require_once("config/loadEnv.php");

loadEnv('.env');

use App\Controller\MovieController;

$con = Database::getConection();
$movieController = new MovieController();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization"); 
header("Access-Control-Allow-Credentials: true"); 

if (strpos($_SERVER['REQUEST_URI'], '/backend/index.php/movies') !== false && $_SERVER['REQUEST_METHOD'] === 'GET' && !preg_match('#^/backend/index.php/movies/(\d+)$#', $_SERVER['REQUEST_URI'])) {
    if (isset($_GET['title']) && !empty($_GET['title'])) {
        $title = $_GET['title'];
        $movies = $movieController->getMoviesByName($title);
    } else {
        $movies = $movieController->fetchAndSaveMovies();
    }
}

elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && preg_match('#^/backend/index.php/movies/(\d+)$#', $_SERVER['REQUEST_URI'], $matches)) {
    $id = intval($matches[1]);
    $movieController->getMovieById($id);
} 

elseif ($_SERVER['REQUEST_METHOD'] === 'PUT' && preg_match('#^/backend/index.php/movies/(\d+)/favorite$#', $_SERVER['REQUEST_URI'], $matches)) {
    $id = intval($matches[1]);

    $data = json_decode(file_get_contents('php://input'), true);
    $isFavorite = isset($data['is_favorite']) ? (bool) $data['is_favorite'] : 'false';
    
    $response = $movieController->updateFavoriteStatus($id, $isFavorite);
    
    echo json_encode(['message' => $response]);
} else {
    error_log("URL ou método da requisição incorretos.");
}
?>
