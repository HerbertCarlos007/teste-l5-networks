<?php

namespace App\Dto;

class MovieResponseByIdDTO
{
    public int $id;
    public string $title;
    public int $episode_id;
    public string $opening_crawl;
    public string $release_date;
    public string $director;
    public string $producer;
    public string $characters;
    public ?string $age;
    public bool $is_favorite;

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
        $this->age = $data['age'];
        $this->is_favorite = $data['is_favorite'] ?? false;
    }
}
