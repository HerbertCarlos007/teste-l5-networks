<?php

namespace App\Dto;

class MovieResponseDto
{
    public int $id;
    public string $title;
    public int $episode_id;
    public string $opening_crawl;
    public string $release_date;
    public string $director;
    public string $producer;
    public array $characters;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->episode_id = $data['episode_id'];
        $this->opening_crawl = $data['opening_crawl'];
        $this->release_date = $data['release_date'];
        $this->director = $data['director'];
        $this->producer = $data['producer'];
        $this->characters = $data['characters'];
    }
}
