<?php

namespace App\Dao;

use Database;
use PDOException;

class MovieDAO
{
    private $pdo;

    public function __construct()
    {
        $databse = new Database();
        $this->pdo = $databse->getConection();
    }

    public function createTableMovie() {
        $sql = "
            CREATE TABLE IF NOT EXISTS movies (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                episode_id INT NOT NULL,
                opening_crawl TEXT,
                release_date DATE,
                director VARCHAR(255),
                producer VARCHAR(255),
                characters TEXT
            )
        ";

        try {
            $this->pdo->exec($sql);
            echo "Tabela movies criada com sucesso";
        } catch(\PDOException $e) {
            die("Erro ao criar tabela movies" . $e->getMessage());
        }
    }

    public function insertMovie($title, $episode_id, $opening_crawl, $release_date, $director, $producer, $characters) {
        $sql = "
            INSERT INTO movies (title, episode_id, opening_crawl, release_date, director, producer, characters)
            VALUES (:title, :episode_id, :opening_crawl, :release_date, :director, :producer, :characters)
        ";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":title" => $title,
                ":episode_id" => $episode_id,
                ":opening_crawl" => $opening_crawl,
                ":release_date" => $release_date,
                ":director" => $director,
                ":producer" => $producer,
                ":characters" => $characters
            ]);
            echo "Filme inserido com sucesso";
        } catch (PDOException $e) {
            die("Erro ao inserir filme" . $e->getMessage());
        }
    }

    public function getMovieCount() {
        $sql = "SELECT COUNT(*) as count FROM movies";
    
        try {
            $stmt = $this->pdo->query($sql);
            $result = $stmt->fetch();
            return $result['count'] ?? 0;
        } catch (PDOException $e) {
            die("Erro ao contar registros na tabela movies: " . $e->getMessage());
        }
    }
    
}
