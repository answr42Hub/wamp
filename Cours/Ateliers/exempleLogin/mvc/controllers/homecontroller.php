<?php

namespace controllers;

class homecontroller {
    function index(): void {
        require __DIR__ . '/../views/home/index.php';
    }
}