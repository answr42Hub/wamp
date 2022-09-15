<?php
$bd = new \PDO('mysql:dbname=n46jolinfocegepl_1409427;host=ftp.420n46.jolinfo.cegep-lanaudiere.qc.ca;port=3307',
    'n46jolinfocegepl_1409427', '<3RickAstley');

$query = $bd->query("SELECT * FROM 'users'");
$result = $query->fetchAll();
var_dump($result);
echo "hello";