<?php

namespace repositories;

class monsterrepository extends baserepository
{
    function getBoss(): bool|\models\monsters\monster {
        $query = $this->bd->query("SELECT * FROM monsters WHERE `isboss` = 1");
        $query->setFetchMode(\PDO::FETCH_CLASS, '\models\monsters\monster');
        $monster = $query->fetch();
        return $monster;
    }

    function getRandMonst(): bool|\models\monsters\monster {
        $query = $this->bd->query("SELECT * FROM monsters WHERE isboss = 0 ORDER BY RAND() LIMIT 1");
        $query->setFetchMode(\PDO::FETCH_CLASS, '\models\monsters\monster');
        $monster = $query->fetch();
        return $monster;
    }

    function insert(\models\monsters\monster $monster) {
        $query = $this->bd->prepare("INSERT INTO monsters (`name`, `maxhp`, `force`, `def`, `img`) VALUES (?, ?, ?, ?, ?)");
        $query->bindValue(1, $monster->name, \PDO::PARAM_STR);
        $query->bindValue(2, $monster->maxhp, \PDO::PARAM_STR);
        $query->bindValue(3, $monster->force, \PDO::PARAM_STR);
        $query->bindValue(4, $monster->def, \PDO::PARAM_STR);
        $query->bindValue(5, $monster->img, \PDO::PARAM_STR);
        $query->execute();
    }
}