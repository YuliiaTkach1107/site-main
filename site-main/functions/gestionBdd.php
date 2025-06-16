<?php

function gestionBdd(){
    static $pdo = null;

    if($pdo === null){
        $config = require __DIR__.'/../config/bdd.php';
try{
    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}; ";
    $pdo = new PDO($dsn, $config['user'], $config['password'],[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    
}
catch(PDOException $e)
{   
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
}
return $pdo;
}
?>
