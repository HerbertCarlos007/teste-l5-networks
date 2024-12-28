<?php
namespace App\Controller;

require_once("App/Dao/MovieDAO.php");
require_once("App/Dao/LogDAO.php");
require_once("App/Models/Movie.php");

use App\Dao\MovieDAO;
use App\Dao\LogDAO;
use App\Models\Movie;

class MovieController {
    private $movieDAO;
    private $logDAO;

    public function __construct() {
        $this->movieDAO = new MovieDAO();
        $this->logDAO = new LogDAO();
        $this->movieDAO->createTableMovie();
        $this->logDAO->createTableLog();
    }

    public function fetchAndSaveMovies() {
        $apiUrl = "https://swapi.py4e.com/api/films";
        $response = file_get_contents($apiUrl);

        $timestamp = date("Y-m-d H:i:s");
        $request = "GET $apiUrl";

        $movieCount = $this->movieDAO->getMovieCount();

        if ($movieCount > 0) {
            echo "A tabela já está preenchida. Nenhum dado foi inserido.";
            return;
        }

        $this->logDAO->insertLog($timestamp, $request);

        if ($response === FALSE) {
            die('Erro ao acessar a API');
        }


        $data = json_decode($response, true);

        foreach ($data['results'] as $movieData) {
            // Requisição para buscar os personagens
            $charactersData = [];
            foreach ($movieData['characters'] as $characterUrl) {
                $characterResponse = file_get_contents($characterUrl);
                if ($characterResponse === FALSE) {
                    die('Erro ao acessar a URL de personagem');
                }

                $character = json_decode($characterResponse, true);
                $charactersData[] = [
                    'name' => $character['name'],
                    'height' => $character['height'],
                    'mass' => $character['mass'],
                    'hair_color' => $character['hair_color'],
                    'skin_color' => $character['skin_color'],
                    'eye_color' => $character['eye_color'],
                    'birth_year' => $character['birth_year'],
                    'gender' => $character['gender']
                ];
            }

            $charactersJson = json_encode($charactersData);

            $movie = new Movie(
                $movieData['title'],
                $movieData['episode_id'],
                $movieData['opening_crawl'],
                $movieData['release_date'],
                $movieData['director'],
                $movieData['producer'],
                $charactersJson
            );

            $this->movieDAO->insertMovie(
                $movie->getTitle(),
                $movie->getEpisodeId(),
                $movie->getOpeningCrawl(),
                $movie->getReleaseDate(),
                $movie->getDirector(),
                $movie->getProducer(),
                $movie->getCharacters()
            );
        }

        echo "Filmes e personagens salvos com sucesso";
    }
}
