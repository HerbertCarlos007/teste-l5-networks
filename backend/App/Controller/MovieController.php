<?php

namespace App\Controller;

require_once("App/Services/MovieService.php");

use App\Service\MovieService;

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
}
