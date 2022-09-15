<?php

class NumberRepository {
    public function __construct() {
        // Source de cette condition: https://stackoverflow.com/a/10093292
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['numbers'])) {
            $_SESSION['numbers'] = [];
        }
    }

    public function add(int $number): void {
        $_SESSION['numbers'][] = $number;
    }

    /** @return []int */
    public function get(): array {
        return $_SESSION['numbers'];
    }
}