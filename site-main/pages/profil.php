<?php
require_once __DIR__. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'gestionSession.php';
require_once __DIR__. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'gestionAuthentification.php';
require_once __DIR__. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'gestionBdd.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'header.php';

initialiserSession(); 

$pdo = gestionBdd();

$utilisateurId = $_SESSION['utilisateurId'];

if (!isset($_SESSION['utilisateurId'])){
    header('Location:connexion.php');
    exit;
}
$pageTitre="Profil";
$metaDescription="Page de profil";

$sql = "SELECT uti_pseudo, uti_email FROM t_utilisateur_uti WHERE uti_id = :id LIMIT 1";

$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $utilisateurId]);
$utilisateur = $stmt->fetch();

if (!$utilisateur) {
    // Пользователь не найден (что-то пошло не так)
    echo "Utilisateur non trouvé";
    exit;
}
echo "Pseudo: " . htmlspecialchars($utilisateur['uti_pseudo']) . "<br>";
echo "Email: " . htmlspecialchars($utilisateur['uti_email']);

if (!estConnectee()) {
    header('Location: connexion.php');  
    exit;
}
?>
<h2>Page de profil</h2>
<form method="post" action="../controllers/deconnexionController.php">
  <button type="submit" name="deconnexion">Déconnexion</button>
</form>
<?php require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'footer.php';?>