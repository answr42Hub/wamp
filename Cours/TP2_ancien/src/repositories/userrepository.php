<?php

namespace repositories;

class userrepository extends baserepository {
    function getOne(string $username): bool|\models\users {
        $query = $this->bd->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $query->bindValue(1, $username, \PDO::PARAM_STR);
        $query->bindValue(2, $username, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, '\models\users');
        return $query->fetch();
    }

    function getEmail(string $email): bool|\models\users {
        $query = $this->bd->prepare("SELECT * FROM users WHERE email = ?");
        $query->bindValue(1, $email, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, '\models\users');
        return $query->fetch();
    }

    function insert(\models\users $user) {
        $query = $this->bd->prepare("INSERT INTO users (username, password, email, expstatus) VALUES (?, ?, ?)");
        $query->bindValue(1, $user->username, \PDO::PARAM_STR);
        $query->bindValue(2, $user->password, \PDO::PARAM_STR);
        $query->bindValue(3, $user->email, \PDO::PARAM_STR);
        $query->binValue(4, time()+(60 * 60));
        $query->execute();
    }

    function updatePass(int $id, string $newPass) {
        $query = $this->bd->prepare("UPDATE users SET password = ? WHERE id = ?");
        $query->bindValue(1, $newPass, \PDO::PARAM_STR);
        $query->bindValue(2, $id, \PDO::PARAM_STR);
        $query->execute();
    }

    function sendResetEmail(string $email) {
        mail($email, "Reset password", "Click on this link to reset password !");
    }

    function getStatus(string $username): bool {
        //change this
        $user = $this->getOne($username);
        if($user)
            return $user->status;
        return false;
    }
}