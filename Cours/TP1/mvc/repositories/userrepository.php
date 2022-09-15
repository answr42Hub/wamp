<?php

namespace repositories;

class userrepository extends baserepository {
    function getOne(string $username): bool|\models\users {
        $query = $this->bd->prepare("SELECT * FROM users WHERE username = ?");
        $query->bindValue(1, $username, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, '\models\users');
        $user = $query->fetch();
        return $user;
    }

    function insert(\models\users $user) {
        $query = $this->bd->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $query->bindValue(1, $user->username, \PDO::PARAM_STR);
        $query->bindValue(2, $user->password, \PDO::PARAM_STR);
        $query->execute();
    }

    function updateExp(int $id, int $exp) {
        $query = $this->bd->prepare("UPDATE users SET exp = ? WHERE id = ?");
        $query->bindValue(1, $exp, \PDO::PARAM_STR);
        $query->bindValue(2, $id, \PDO::PARAM_STR);
        $query->execute();
    }


}