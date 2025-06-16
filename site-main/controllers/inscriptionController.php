<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'gestionSession.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..'.DIRECTORY_SEPARATOR.'functions'. DIRECTORY_SEPARATOR . 'gestionAuthentification.php';
require_once __DIR__ . DIRECTORY_SEPARATOR. '..'.DIRECTORY_SEPARATOR.'functions'. DIRECTORY_SEPARATOR . 'gestionBdd.php';

initialiserSession();

$pdo = gestionBdd();

$pseudo = $_POST['inscription_pseudo'] ?? '';
$mdp =  $_POST['inscription_motDePasse'] ?? '';
$email = $_POST['inscription_email'] ?? '';
$mdp_conf= $_POST['inscription_motDePasse_confirmation'] ?? '';

$valeurs = ['pseudo' => $pseudo, 'email' => $email];

$erreurs=[];

if(strlen($pseudo)<2){
    $erreurs['pseudo']='Le pseudo est trop court';
}
elseif (strlen($pseudo) > 10) {
    $erreurs['pseudo'] = 'Le pseudo ne doit pas dépasser 10 caractères';
}
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $erreurs['email']='Email invalide';
}
if($mdp!==$mdp_conf){
    $erreurs['motdepasse']='Les mots de passe ne correspondent pas';
}
if(strlen($mdp)<8){
    $erreurs['motdepasse']='Le mots de passe doit contenir au moins 8 caractères.';
}

$sql = "SELECT COUNT(*) FROM t_utilisateur_uti WHERE uti_pseudo = :pseudo OR uti_email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute(['pseudo' => $pseudo, 'email' => $email]);
$existe = $stmt->fetchColumn() > 0;

if($existe){
    $erreurs[]="Le pseudo ou l'email existe déja";
}
if(!empty($erreurs)){
    $_SESSION['formErreurs'] = $erreurs;
    $_SESSION['formValeurs'] = $valeurs;
    header('Location: ../pages/inscription.php');
    exit;
}

$hash = password_hash($mdp, PASSWORD_DEFAULT);
$sql = "INSERT INTO t_utilisateur_uti (uti_pseudo, uti_email, uti_motdepasse) VALUES (:pseudo, :email, :motdepasse)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'pseudo' => $pseudo,
    'email' => $email,
    'motdepasse' => $hash
]);
$userId = $pdo->lastInsertId();
connecterUtilisateur($userId);

header('Location: ../pages/profil.php');
exit;

?>