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

class MovieService
{
    private $movieDAO;
    private $logDAO;
    private $timestamp;

    public function __construct()
    {
        date_default_timezone_set('America/Sao_Paulo');

        $this->movieDAO = new MovieDAO();
        $this->logDAO = new LogDAO();
        $this->movieDAO->createTableMovie();
        $this->logDAO->createTableLog();
        $this->timestamp = date("Y-m-d H:i:s");
    }

    public function fetchAndSaveMovies(): array
    {
        $moviesData = $this->movieDAO->getAllMovies();
        if (count($moviesData) > 0) {
            return array_map(fn($movieData) => new MovieResponseDTO($movieData), $moviesData);
        }
    
        $apiUrl = getenv('API_URL');
        $response = file_get_contents($apiUrl);
    
        $this->logDAO->insertLog($this->timestamp, "GET $apiUrl");
    
        if ($response === FALSE) {
            throw new \Exception('Erro ao acessar a API');
        }
    
        $data = json_decode($response, true);
        $movies = [];
    
        $allCharacterUrls = [];
        foreach ($data['results'] as $movieData) {
            $allCharacterUrls = array_merge($allCharacterUrls, $movieData['characters']);
        }

        $allCharacterUrls = array_unique($allCharacterUrls);
    
        $charactersData = [];
        foreach ($allCharacterUrls as $characterUrl) {
            $characterResponse = file_get_contents($characterUrl);
            if ($characterResponse === FALSE) {
                throw new \Exception("Erro ao acessar a URL do personagem: $characterUrl");
            }
            $character = json_decode($characterResponse, true);
            $charactersData[$characterUrl] = $character['name'];
        }
    
        foreach ($data['results'] as $movieData) {
            $charactersNames = array_map(fn($url) => $charactersData[$url] ?? 'Desconhecido', $movieData['characters']);
    
            $movie = new Movie(
                $movieData['title'],
                $movieData['episode_id'],
                $movieData['opening_crawl'],
                $movieData['release_date'],
                $movieData['director'],
                $movieData['producer'],
                implode(', ', $charactersNames),
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

        $request = "GET /backend/index.php/movies/{$id}";
        $this->logDAO->insertLog($this->timestamp, $request);

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

    public function updateIsFavorite(int $id, bool $isFavorite): bool
    {
        $request = "GET /backend/index.php/movies/{$id}/favorite";
        try {
            $this->logDAO->insertLog($this->timestamp, $request);
            return $this->movieDAO->updateIsFavorite($id, $isFavorite);
        } catch (Exception $e) {
            die("Erro ao atualizar status de favorito: " . $e->getMessage());
        }
    }

    public function getMoviesByName($title): array
    {
        $request = "GET /backend/index.php/movies?={$title}";
        try {
            $this->logDAO->insertLog($this->timestamp, $request);
            return $this->movieDAO->filterByName($title);
        } catch (Exception $e) {
            die("Erro ao buscar filmes: " . $e->getMessage());
        }
    }

    public function getAllFavoriteMovies(): array {

        $request = "GET /backend/index.php/movies/favorites";
        try{
            $this->logDAO->insertLog($this->timestamp, $request);
            return $this->movieDAO->getAllFavoriteMovies();
        } catch (Exception $e) {
            die("Erro ao buscar filmes: " . $e->getMessage());
        }
    }
}
