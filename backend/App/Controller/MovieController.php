<?php

namespace App\Controller;

require_once("App/Services/MovieService.php");

use App\Service\MovieService;
use Exception;

class MovieController
{
    private $movieService;

    public function __construct()
    {
        $this->movieService = new MovieService();
    }

    public function fetchAndSaveMovies()
    {
        $movies = $this->movieService->fetchAndSaveMovies();

        header('Content-Type: application/json');
        echo json_encode($movies);
    }

    public function getMovieById($id)
    {
        $movie = $this->movieService->getMovieById($id);
        header('Content-Type: application/json');
        echo json_encode($movie);
    }

    public function updateFavoriteStatus($id, $isFavorite)
    {
        try {
            // Chama a função de atualização diretamente sem verificar o sucesso
            return $this->movieService->updateIsFavorite($id, $isFavorite);
        } catch (Exception $e) {
            // Retorna o erro real sem esconder
            return 'Erro ao atualizar status de favorito: ' . $e->getMessage();
        }
    }
    
}
