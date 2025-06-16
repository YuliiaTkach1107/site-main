<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'gestionSession.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'gestionAuthentification.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'gestionBdd.php';

initialiserSession();

$pdo = gestionBdd();

$mdp =  $_POST['connexion_motDePasse'] ?? '';
$pseudo = $_POST['connexion_pseudo'] ?? '';
$valeurs = ['pseudo' => $pseudo];

$erreurs=[];
// Проверяем, что данные не пустые
if (!$pseudo) {
    $erreurs['pseudo'] = "Pseudo est requis.";
    exit;
}
if(!$mdp){
    $erreurs['mdp'] = " Mot de passe est requis.";
}

if (empty($erreurs)) {
    $sql = "SELECT uti_id, uti_motdepasse FROM t_utilisateur_uti WHERE uti_pseudo = :pseudo";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['pseudo' => $pseudo]);

    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur) {
        if (password_verify($mdp, $utilisateur['uti_motdepasse'])) {
            connecterUtilisateur($utilisateur['uti_id']);
            header('Location: ../pages/profil.php');
            exit;
        } else {
            $erreurs['mdp'] = "Mot de passe incorrect.";
        }
    } else {
        $erreurs['pseudo'] = "Utilisateur non trouvé.";
    }
}
$_SESSION['connexion_erreurs'] = $erreurs;
$_SESSION['connexion_valeurs'] = $valeurs;

// Возврат на страницу входа
header('Location: ../pages/connexion.php');
?>