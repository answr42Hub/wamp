<?php

namespace repositories;

use models\users;

class userrepository extends baserepository {
    function getOne(string $username): bool|\models\users {
        $query = $this->bd->prepare("SELECT * FROM users WHERE username = ? OR email = ? OR token = ? OR remember = ?");
        $query->bindValue(1, $username, \PDO::PARAM_STR);
        $query->bindValue(2, $username, \PDO::PARAM_STR);
        $query->bindValue(3, $username, \PDO::PARAM_STR);
        $query->bindValue(4, $username, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, '\models\users');
        return $query->fetch();
    }

    function insert(\models\users $user) {
        $query = $this->bd->prepare("INSERT INTO users (username, password, email, token, exptoken) VALUES (?, ?, ?, ?, ?)");
        $query->bindValue(1, $user->username, \PDO::PARAM_STR);
        $query->bindValue(2, $user->password, \PDO::PARAM_STR);
        $query->bindValue(3, $user->email, \PDO::PARAM_STR);
        $query->bindValue(4, $user->token, \PDO::PARAM_STR);
        $query->bindValue(5, time()+(3600));
        $query->execute();
    }

    function updatePass(string $token, string $newPass) {
        $user = new users();
        $user = $this->getOne($token);
        if($user) {
            if(!is_null($user->token))
                $this->confirm($token);

            $query = $this->bd->prepare("UPDATE users SET password = ? WHERE id = ?");
            $query->bindValue(1, $newPass, \PDO::PARAM_STR);
            $query->bindValue(2, $user->id, \PDO::PARAM_STR);
            $query->execute();
        }
    }

    function confirm(string $token): bool {
        $user = new users();
        $query = $this->bd->prepare("SELECT * FROM users WHERE token = ?");
        $query->bindValue(1, $token, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, '\models\users');
        $user = $query->fetch();

        if($user) {
            if(!$user->exptoken - time() <= 0) {
                $query = $this->bd->prepare("UPDATE users SET token = ?, status = ?, exptoken = ? WHERE id = ?");
                $query->bindValue(1, null, \PDO::PARAM_STR);
                $query->bindValue(2, 1, \PDO::PARAM_STR);
                $query->bindValue(3, 0, \PDO::PARAM_STR);
                $query->bindValue(4, $user->id, \PDO::PARAM_STR);
                $query->execute();
                return true;
            }
        }
        return false;
    }

    function setRemember(int $id, string $token) {
        $query = $this->bd->prepare("UPDATE users SET remember = ?, expremember = ? WHERE id = ?");
        $query->bindValue(1, $token, \PDO::PARAM_STR);
        $query->bindValue(2, time()+(30*24*60*60), \PDO::PARAM_STR);
        $query->bindValue(3, $id, \PDO::PARAM_STR);
        $query->execute();
    }

    function forgetMe(string $id) {
        $query = $this->bd->prepare("UPDATE users SET remember = ?, expremember = ? WHERE id = ?");
        $query->bindValue(1, null, \PDO::PARAM_STR);
        $query->bindValue(2, 0, \PDO::PARAM_STR);
        $query->bindValue(3, $id, \PDO::PARAM_STR);
        $query->execute();
    }

    function unconfirm(string $email) {
        $user = new users();
        $user = $this->getOne($email);
        $query = $this->bd->prepare("UPDATE users SET token = ?, status = ?, exptoken = ? WHERE id = ?");
        $query->bindValue(1, hash('sha256', random_bytes(16)), \PDO::PARAM_STR);
        $query->bindValue(2, 0, \PDO::PARAM_STR);
        $query->bindValue(3, time()+(3600), \PDO::PARAM_STR);
        $query->bindValue(4, $user->id, \PDO::PARAM_STR);
        $query->execute();
        return true;
    }

    function getStatus(string $username): bool {
        //change this
        $user = $this->getOne($username);
        if($user)
            return $user->status;
        return false;
    }
}