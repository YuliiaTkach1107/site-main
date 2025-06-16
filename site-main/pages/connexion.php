<?php

$pageTitre="Connexion";
$metaDescription="Page de connexion";
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'gestionSession.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'gestionAuthentification.php';
require_once __DIR__. DIRECTORY_SEPARATOR . '..' .DIRECTORY_SEPARATOR .'includes'.DIRECTORY_SEPARATOR.'header.php';
$erreurs = $_SESSION['connexion_erreurs'] ?? [];
$messageSucces = $_SESSION['connexion_succes'] ?? null;
initialiserSession();
$erreurs = $_SESSION['connexion_erreurs'] ?? [];
$valeurs = $_SESSION['connexion_valeurs'] ?? [];

unset($_SESSION['connexion_erreurs'], $_SESSION['connexion_succes']);
?>
<h2>Page de connexion</h2>

<form method="post" action="../controllers/connexionController.php" novalidate>

    <p>
    <label for="connexion_pseudo">Pseudo:</label>
        <input type="text" name="connexion_pseudo" id="connexion_pseudo"
               value="<?= htmlspecialchars($valeurs['pseudo'] ?? '') ?>"
               required minlength="2" maxlength="255">
        <?php if (isset($erreurs['pseudo'])): ?>
            <br><span><?= htmlspecialchars($erreurs['pseudo']) ?></span>
        <?php endif; ?>
    </p>
    <p>
    <label for="connexion_motDePasse">Mot de passe:</label>
        <input type="password" name="connexion_motDePasse" id="connexion_motDePasse"
               required minlength="8" maxlength="72">
        <?php if (isset($erreurs['mdp'])): ?>
            <br><span><?= htmlspecialchars($erreurs['mdp']) ?></span>
        <?php endif; ?>
    </p>
        <button type="submit">Se connecter</button>
    
</form>

<p>Pas encore de compte ? <a href="inscription.php">Inscrivez-vous ici</a></p>
    <?php require_once __DIR__. DIRECTORY_SEPARATOR . '..' .DIRECTORY_SEPARATOR .'includes'.DIRECTORY_SEPARATOR.'footer.php';?>