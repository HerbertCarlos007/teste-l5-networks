<?php

namespace App\Models;

class Log
{
    private $timestamp;
    private $request;
  
    
    public function __construct($timestamp, $request)
    {
        $this->timestamp = $timestamp;
        $this->request = $request;
    }

  
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getEpisodeId()
    {
        return $this->request;
    }

}
