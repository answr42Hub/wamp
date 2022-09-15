<?php

namespace models;

class door
{
    public string $content;
    public bool $visited;

    public function __construct(string $content) {
        $this->content = $content;
        $this->visited = false;
    }
}