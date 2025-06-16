<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'gestionSession.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..'.DIRECTORY_SEPARATOR.'functions'. DIRECTORY_SEPARATOR . 'gestionAuthentification.php';

if($_SERVER['REQUEST_METHOD']==='POST'&& isset($_POST['deconnexion'])){
    deconnecterUtilisateur(); 
    detruireSession();
    header('Location: ../pages/connexion.php');
    exit;
}

?>