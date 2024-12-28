<?php

namespace App\Dao;

use Database;
use PDOException;

require_once("config/Database.php");

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
                name VARCHAR(255) NOT NULL,
                episode_number INT NOT NULL,
                synopsis TEXT,
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

    public function insertMovie($name, $episode, $synopsis, $release_date, $director, $producer, $characters) {
        $sql = "
            INSERT INTO movies (name, episode, synopsis, release_date, director, producer, characters)
            VALUES (:name, :episode, :synopsis, :release_date, :director, :producer, :characters)
        ";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":name" => $name,
                ":episode" => $episode,
                ":synopsis" => $synopsis,
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
}
