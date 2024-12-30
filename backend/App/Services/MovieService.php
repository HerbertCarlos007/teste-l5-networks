<?php

namespace App\Service;

require_once("App/Dao/MovieDAO.php");
require_once("App/Dao/LogDAO.php");
require_once("App/Models/Movie.php");
require_once("App/DTO/MovieResponseDTO.php");
require_once("App/DTO/MovieResponseByIdDTO.php");

use App\Dao\MovieDAO;
use App\Dao\LogDAO;
use App\Models\Movie;
use App\Dto\MovieResponseDTO;
use App\Dto\MovieResponseByIdDTO;
use Exception;
use PDOException;

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
            return array_map(fn($movieData) => new MovieResponseDTO($movieData), $moviesData);
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
                implode(', ', $charactersData),
                $movieData['is_favorite'] ?? false
            );

            $movieId = $this->movieDAO->insertMovie(
                $movie->getTitle(),
                $movie->getEpisodeId(),
                $movie->getOpeningCrawl(),
                $movie->getReleaseDate(),
                $movie->getDirector(),
                $movie->getProducer(),
                $movie->getCharacters(),
                $movie->getIsFavorite()
            );

            $movies[] = new MovieResponseDto([
                'id' => $movieId,
                'title' => $movie->getTitle(),
                'episode_id' => $movie->getEpisodeId(),
                'opening_crawl' => $movie->getOpeningCrawl(),
                'release_date' => $movie->getReleaseDate(),
                'director' => $movie->getDirector(),
                'producer' => $movie->getProducer(),
                'characters' => $movie->getCharacters()
            ]);
        }
        return $movies;
    }

    public function getMovieById($id): ?MovieResponseByIdDTO
    {
        $movieData = $this->movieDAO->getMovieById($id);

        $timestamp = date("Y-m-d H:i:s");
        $request = "GET /backend/index.php/movies/{$id}";
        $this->logDAO->insertLog($timestamp, $request);

        if (!$movieData) {
            return null;
        }

        $movie = new Movie(
            $movieData['title'],
            $movieData['episode_id'],
            $movieData['opening_crawl'],
            $movieData['release_date'],
            $movieData['director'],
            $movieData['producer'],
            $movieData['characters'],
            $movieData['is_favorite']
        );

        $movieAge = $movie->getMovieAge();
        $movieData['age'] = $movieAge;

        return new MovieResponseByIdDTO($movieData);
    }

    public function updateIsFavorite(int $id, bool $isFavorite)
    {
        try {
            return $this->movieDAO->updateIsFavorite($id, $isFavorite);
        } catch (Exception $e) {
            die("Erro ao atualizar status de favorito: " . $e->getMessage());
        }
    }
}
