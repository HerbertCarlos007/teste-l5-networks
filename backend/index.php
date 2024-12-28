<?php
require_once("config/Database.php");
require_once("App/Controller/MovieController.php");

use App\Controller\MovieController;

$con = Database::getConection();
$movieController = new MovieController();

// Depuração para verificar a URL e o método da requisição
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "<br>";

// Ajustando a verificação da URL para considerar o prefixo '/backend/index.php/'
if (strpos($_SERVER['REQUEST_URI'], '/backend/index.php/movies') !== false && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $movies = $movieController->fetchAndSaveMovies();
    echo "Filmes salvos com sucesso";
} else {
    echo "URL ou método da requisição incorretos.";
}
?>
