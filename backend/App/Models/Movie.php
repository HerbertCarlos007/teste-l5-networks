<?php

namespace App\Models;

use DateTime;

class Movie
{
    private $title;
    private $episode_id;
    private $opening_crawl;
    private $release_date;
    private $director;
    private $producer;
    private $characters;
    
    public function __construct($title, $episode_id, $opening_crawl, $release_date, $director, $producer, $characters)
    {
        $this->title = $title;
        $this->episode_id = $episode_id;
        $this->opening_crawl = $opening_crawl;
        $this->release_date = new DateTime($release_date);
        $this->director = $director;
        $this->producer = $producer;
        $this->characters = $characters;
    }

  
    public function getTitle()
    {
        return $this->title;
    }

    public function getEpisodeId()
    {
        return $this->episode_id;
    }

    public function getOpeningCrawl()
    {
        return $this->opening_crawl;
    }

    public function getReleaseDate()
    {
        return $this->release_date->format('Y-m-d');
    }

    public function getDirector()
    {
        return $this->director;
    }

    public function getProducer()
    {
        return $this->producer;
    }

    public function getCharacters()
    {
        return $this->characters;
    }

    public function getMovieAge()
    {
        $now = new DateTime();
        $interval = $this->release_date->diff($now);

        return $interval->y . ' anos, ' . $interval->m . ' meses, ' . $interval->d . ' dias';
    }
}
