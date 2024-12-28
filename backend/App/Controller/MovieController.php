<?php

namespace App\Controller;

require_once("App/Dao/MovieDAO.php");
require_once("App/Dao/LogDAO.php");
require_once("App/Models/Movie.php");

use App\Dao\MovieDAO;
use App\Dao\LogDAO;
use App\Models\Movie;

class MovieController
{
    private $movieDAO;
    private $logDAO;

    public function __construct()
    {
        $this->movieDAO = new MovieDAO();
        $this->logDAO = new LogDAO();
        $this->movieDAO->createTableMovie();
        $this->logDAO->createTableLog();
    }

    public function fetchAndSaveMovies()
    {
        $movieCount = $this->movieDAO->getMovieCount();
    
        if ($movieCount > 0) {
            $moviesData = $this->movieDAO->getAllMovies();
            $movies = [];
    
            foreach ($moviesData as $movieData) {
                $movie = new Movie(
                    $movieData['title'],
                    $movieData['episode_id'],
                    $movieData['opening_crawl'],
                    $movieData['release_date'],
                    $movieData['director'],
                    $movieData['producer'],
                    $movieData['characters']
                );
    
                $movies[] = [
                    'id' => $movieData['id'],
                    'title' => $movie->getTitle(),
                    'episode_id' => $movie->getEpisodeId(),
                    'opening_crawl' => $movie->getOpeningCrawl(),
                    'release_date' => $movie->getReleaseDate(),
                    'director' => $movie->getDirector(),
                    'producer' => $movie->getProducer(),
                    'characters' => json_decode($movie->getCharacters())
                ];
            }
    
            header('Content-Type: application/json');
            echo json_encode($movies);
            return;
        }
    
        $apiUrl = "https://swapi.py4e.com/api/films";
        $response = file_get_contents($apiUrl);
    
        $timestamp = date("Y-m-d H:i:s");
        $request = "GET $apiUrl";
    
        $this->logDAO->insertLog($timestamp, $request);
    
        if ($response === FALSE) {
            die('Erro ao acessar a API');
        }
    
        $data = json_decode($response, true);
        $movies = [];
    
        foreach ($data['results'] as $movieData) {
            $charactersData = [];
            foreach ($movieData['characters'] as $characterUrl) {
                $characterResponse = file_get_contents($characterUrl);
                if ($characterResponse === FALSE) {
                    die('Erro ao acessar a URL de personagem');
                }
    
                $character = json_decode($characterResponse, true);
                $charactersData[] = $character['name'];
            }
    
            $charactersString = implode(', ', $charactersData);
    
            $movie = new Movie(
                $movieData['title'],
                $movieData['episode_id'],
                $movieData['opening_crawl'],
                $movieData['release_date'],
                $movieData['director'],
                $movieData['producer'],
                $charactersString
            );
    
            $movieId = $this->movieDAO->insertMovie(
                $movie->getTitle(),
                $movie->getEpisodeId(),
                $movie->getOpeningCrawl(),
                $movie->getReleaseDate(),
                $movie->getDirector(),
                $movie->getProducer(),
                $movie->getCharacters()
            );
    
            $movies[] = [
                'id' => $movieId,
                'title' => $movie->getTitle(),
                'episode_id' => $movie->getEpisodeId(),
                'opening_crawl' => $movie->getOpeningCrawl(),
                'release_date' => $movie->getReleaseDate(),
                'director' => $movie->getDirector(),
                'producer' => $movie->getProducer(),
                'characters' => $charactersString
            ];
        }
    
        header('Content-Type: application/json');
        echo json_encode($movies);
    }
    


    public function getMovieById($id)
    {
        $timestamp = date("Y-m-d H:i:s");
        $request = "GET /backend/index.php/movies/{$id}";

        $this->logDAO->insertLog($timestamp, $request);

        $movieData = $this->movieDAO->getMovieById($id);

        if ($movieData) {
            $movie = new Movie(
                $movieData['title'],
                $movieData['episode_id'],
                $movieData['opening_crawl'],
                $movieData['release_date'],
                $movieData['director'],
                $movieData['producer'],
                $movieData['characters']
            );

            $movieAge = $movie->getMovieAge();
            $movieData['age'] = $movieAge;

            header('Content-Type: application/json');
            echo json_encode($movieData);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Filme não encontrado.']);
        }
    }
}
