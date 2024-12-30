<?php

namespace App\Dao;

use Database;
use PDO;
use PDOException;

class MovieDAO
{
    private $pdo;

    public function __construct()
    {
        $databse = new Database();
        $this->pdo = $databse->getConection();
    }

    public function createTableMovie()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS movies (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                episode_id INT NOT NULL,
                opening_crawl TEXT,
                release_date DATE,
                director VARCHAR(255),
                producer VARCHAR(255),
                characters TEXT,
                is_favorite TINYINT(1) DEFAULT 0
            )
        ";

        try {
            $this->pdo->exec($sql);
        } catch (\PDOException $e) {
            die("Erro ao criar tabela movies" . $e->getMessage());
        }
    }

    public function insertMovie($title, $episode_id, $opening_crawl, $release_date, $director, $producer, $characters, $is_favorite)
    {
        $sql = "
            INSERT INTO movies (title, episode_id, opening_crawl, release_date, director, producer, characters, is_favorite)
            VALUES (:title, :episode_id, :opening_crawl, :release_date, :director, :producer, :characters, :is_favorite)
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
                ":characters" => $characters,
                ":is_favorite" => $is_favorite
            ]);
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Erro ao inserir filme" . $e->getMessage());
        }
    }

    public function getAllMovies()
    {
        $sql = "SELECT * FROM movies";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getMovieById($id)
    {
        $sql = "SELECT * FROM movies WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $movie = $stmt->fetch();

            if ($movie) {
                return $movie;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            die("Erro ao buscar filme pelo ID: " . $e->getMessage());
        }
    }

    public function getMovieCount()
    {
        $sql = "SELECT COUNT(*) as count FROM movies";

        try {
            $stmt = $this->pdo->query($sql);
            $result = $stmt->fetch();
            return $result['count'] ?? 0;
        } catch (PDOException $e) {
            die("Erro ao contar registros na tabela movies: " . $e->getMessage());
        }
    }

    public function updateIsFavorite(int $id , bool $isFavorite) {
        $sql = "UPDATE movies SET is_favorite = :is_favorite WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':is_favorite' => $isFavorite,
            ]);
                return $stmt->rowCount() > 0;

        }catch (PDOException $e) {
            die("Erro ao atualizar filme como favorito: " . $e->getMessage());
        }
    }
    
    public function filterByName($title) {
        $sql = "SELECT * FROM movies WHERE title LIKE :title";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':title' => '%' . $title . '%',
            ]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e) {
            die("Erro ao filtrar filme " . $e->getMessage());
        }
    }
}
