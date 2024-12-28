<?php
require_once("config/Database.php");
require_once("App/Controller/MovieController.php");

use App\Controller\MovieController;

$con = Database::getConection();
$movieController = new MovieController();

echo "Request URI: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "<br>";

if (strpos($_SERVER['REQUEST_URI'], '/backend/index.php/movies') !== false && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $movies = $movieController->fetchAndSaveMovies();
    echo "Filmes salvos com sucesso";
} else {
    echo "URL ou método da requisição incorretos.";
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && preg_match('#^/backend/index.php/movies/(\d+)$#', $_SERVER['REQUEST_URI'], $matches)) {
    $id = intval($matches[1]);
    $movieController->getMovieById($id);
} else {
    echo "ID não fornecido ou método incorreto.";
}
?>
