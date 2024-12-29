<?php

namespace App\Service;

require_once("App/Dao/MovieDAO.php");
require_once("App/Dao/LogDAO.php");
require_once("App/Models/Movie.php");
require_once("App/Dto/MovieResponseDto.php");

use App\Dao\MovieDAO;
use App\Dao\LogDAO;
use App\Models\Movie;
use App\Dto\MovieResponseDto;

class MovieService
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

    public function fetchAndSaveMovies(): array
    {
        $moviesData = $this->movieDAO->getAllMovies();

        if (count($moviesData) > 0) {
            return array_map(fn($movieData) => new MovieResponseDto($movieData), $moviesData);
        }

        $apiUrl = getenv('API_URL');
        $response = file_get_contents($apiUrl);

        $this->logDAO->insertLog(date("Y-m-d H:i:s"), "GET $apiUrl");

        if ($response === FALSE) {
            throw new \Exception('Erro ao acessar a API');
        }

        $data = json_decode($response, true);
        $movies = [];

        foreach ($data['results'] as $movieData) {
            $charactersData = [];
            foreach ($movieData['characters'] as $characterUrl) {
                $characterResponse = file_get_contents($characterUrl);
                if ($characterResponse === FALSE) {
                    throw new \Exception('Erro ao acessar a URL de personagem');
                }

                $character = json_decode($characterResponse, true);
                $charactersData[] = $character['name'];
            }

            $movie = new Movie(
                $movieData['title'],
                $movieData['episode_id'],
                $movieData['opening_crawl'],
                $movieData['release_date'],
                $movieData['director'],
                $movieData['producer'],
                implode(', ', $charactersData)
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

            $movies[] = new MovieResponseDto([
                'id' => $movieId,
                'title' => $movie->getTitle(),
                'episode_id' => $movie->getEpisodeId(),
                'opening_crawl' => $movie->getOpeningCrawl(),
                'release_date' => $movie->getReleaseDate(),
                'director' => $movie->getDirector(),
                'producer' => $movie->getProducer(),
                'characters' => explode(', ', $movie->getCharacters())
            ]);
        }

        return $movies;
    }

    public function getMovieById($id): ?MovieResponseDto
    {
        $movieData = $this->movieDAO->getMovieById($id);
        $this->logDAO->insertLog(date("Y-m-d H:i:s"), "GET /movies/{$id}");

        if (!$movieData) {
            return null;
        }

        return new MovieResponseDto($movieData);
    }
}
