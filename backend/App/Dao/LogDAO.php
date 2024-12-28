<?php

namespace App\Dao;

use Database;
use PDOException;

class LogDAO
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getConection();
    }

    public function createTableLog()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS logs (
                id INT AUTO_INCREMENT PRIMARY KEY,
                timestamp DATETIME NOT NULL,
                request VARCHAR(255) NOT NULL
            )
        ";

        try {
            $this->pdo->exec($sql);
        } catch (\PDOException $e) {
            die("Erro ao criar tabela log: " . $e->getMessage());
        }
    }

    public function insertLog($timestamp, $request)
    {
        $sql = "
            INSERT INTO logs (timestamp, request)
            VALUES (:timestamp, :request);
        ";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'timestamp' => $timestamp,
                'request' => $request
            ]);
        } catch (PDOException $e) {
            die("Erro ao inserir log: " . $e->getMessage());
        }
    }
}
