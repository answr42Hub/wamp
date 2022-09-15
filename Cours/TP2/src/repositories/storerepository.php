<?php

namespace repositories;

use models\transactions;

class storerepository extends baserepository
{
    function getOne(string $id): bool|\models\articles {
        $query = $this->bd->prepare("SELECT * FROM articles WHERE id = ?");
        $query->bindValue(1, $id, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, '\models\articles');
        return $query->fetch();
    }

    function getAllArticles(): bool|array {
        $query = $this->bd->prepare("SELECT * FROM articles");
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, '\models\articles');
        return $query->fetchAll();
    }

    function getUserArticles($id) : bool|array {
        $query = $this->bd->prepare("SELECT * FROM articles WHERE seller = ?");
        $query->bindValue(1, $id, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, '\models\articles');
        return $query->fetchAll();
    }

    function addArticle(\models\articles $article) {
        $query = $this->bd->prepare("INSERT INTO `articles` (`name`, `desc`, `price`, `image`, `creationdate`, `seller`) VALUES (?, ?, ?, ?, ?, ?);");
        $query->bindValue(1, $article->name, \PDO::PARAM_STR);
        $query->bindValue(2, $article->desc, \PDO::PARAM_STR);
        $query->bindValue(3, $article->price, \PDO::PARAM_STR);
        $query->bindValue(4, $article->image, \PDO::PARAM_STR);
        $query->bindValue(5, time(), \PDO::PARAM_STR);
        $query->bindValue(6, $article->seller, \PDO::PARAM_STR);
        $query->execute();
    }

    function editArticle(\models\articles $article) {
        $query = $this->bd->prepare("UPDATE `articles` set `name` = ?, `desc`= ?, `price` = ?, `image` = ?, `creationdate` = ?, `seller` = ?, `sold` = ? WHERE `id` = ?");
        $query->bindValue(1, $article->name, \PDO::PARAM_STR);
        $query->bindValue(2, $article->desc, \PDO::PARAM_STR);
        $query->bindValue(3, $article->price, \PDO::PARAM_STR);
        $query->bindValue(4, $article->image, \PDO::PARAM_STR);
        $query->bindValue(5, $article->creationdate, \PDO::PARAM_STR);
        $query->bindValue(6, $article->seller, \PDO::PARAM_STR);
        $query->bindValue(7, $article->sold, \PDO::PARAM_STR);
        $query->bindValue(8, $article->id, \PDO::PARAM_STR);
        $query->execute();
    }

    function addTransaction(\models\transactions $transaction) {
        $query = $this->bd->prepare("INSERT INTO transactions (paymentid, numfact, usercustomer, userseller, article, price, status, datepayment) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bindValue(1, $transaction->paymentid, \PDO::PARAM_STR);
        $query->bindValue(2, $transaction->numfact, \PDO::PARAM_STR);
        $query->bindValue(3, $transaction->usercustomer, \PDO::PARAM_STR);
        $query->bindValue(4, $transaction->userseller, \PDO::PARAM_STR);
        $query->bindValue(5, $transaction->article, \PDO::PARAM_STR);
        $query->bindValue(6, $transaction->price, \PDO::PARAM_STR);
        $query->bindValue(7, $transaction->status, \PDO::PARAM_STR);
        $query->bindValue(8, time(), \PDO::PARAM_STR);
        $query->execute();
    }

    function cancelTransaction(int $id) {
        $query = $this->bd->prepare("UPDATE `transactions` set `status` = 0 WHERE `ìd` = ?");
        $query->bindValue(1, $id, \PDO::PARAM_STR);
        $query->execute();
    }

    function getMyTransaction(int $articleid, int $buyer): bool|\models\transactions {
        $query = $this->bd->prepare("SELECT * FROM `transactions` WHERE `article` = ? AND `usercustomer` = ? AND `status` = 1");
        $query->bindValue(1, $articleid, \PDO::PARAM_STR);
        $query->bindValue(2, $buyer, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, '\models\transactions');
        return $query->fetch();
    }

    function getMyPurchases(int $id): bool|array {
        $query = $this->bd->prepare("SELECT articles.id, articles.name, articles.desc, articles.price, articles.image, articles.creationdate, articles.seller, articles.sold FROM articles INNER JOIN transactions ON articles.id = transactions.article WHERE usercustomer = ? AND status = 1");
        $query->bindValue(1, $id, \PDO::PARAM_STR);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, '\models\articles');
        return $query->fetchAll();
    }
}