<?php

namespace App\Models;

use DateTime;

class Movie
{
    private $name;
    private $episode_number;
    private $synopsis;
    private $release_date;
    private $director;
    private $producer;
    private $characters;
    
    public function __construct($name, $episode_number, $synopsis, $release_date, $director, $producer, $characters)
    {
        $this->name = $name;
        $this->episode_number = $episode_number;
        $this->synopsis = $synopsis;
        $this->release_date = new DateTime($release_date);  // Converte a string para objeto DateTime
        $this->director = $director;
        $this->producer = $producer;
        $this->characters = $characters;
    }

  
    public function getName()
    {
        return $this->name;
    }

    public function getEpisodeNumber()
    {
        return $this->episode_number;
    }

    public function getSynopsis()
    {
        return $this->synopsis;
    }

    public function getReleaseDate()
    {
        return $this->release_date->format('Y-m-d');
    }

    public function getDirectors()
    {
        return $this->director;
    }

    public function getProducers()
    {
        return $this->producer;
    }

    public function getCharacters()
    {
        return $this->characters;
    }

    // Método para calcular a idade do filme em anos, meses e dias
    public function getMovieAge()
    {
        $now = new DateTime();
        $interval = $this->release_date->diff($now);

        return $interval->y . ' years, ' . $interval->m . ' months, ' . $interval->d . ' days';
    }
}
