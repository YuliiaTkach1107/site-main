<?php
$pageTitre="Inscription";
$metaDescription="Page d'inscription. Vous pouvez vous inscrire ici. ";
require_once __DIR__. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'gestionSession.php';
require_once __DIR__. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'gestionAuthentification.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'header.php';

initialiserSession(); 


$erreurs = $_SESSION['formErreurs'] ?? [];
$valeurs = $_SESSION['formValeurs'] ?? [
    'pseudo' => '',
    'email' => ''
];


unset($_SESSION['formErreurs'], $_SESSION['formValeurs']);


if (estConnectee()) {
    header('Location: profil.php');
    exit;
}
?>
<h2>Page d'inscription</h2>

<form method="post" action="../controllers/inscriptionController.php" novalidate>
<p>
<label for="inscription_pseudo" class="obligatoire">Pseudo:</label>
  <input type="text" name="inscription_pseudo" id="inscription_pseudo"
         value="<?= htmlspecialchars($valeurs['pseudo']) ?>"
         required minlength="2" maxlength="10" placeholder="Champ obligatoire">
  <?php if (isset($erreurs['pseudo'])): ?>
<br><span><?= htmlspecialchars($erreurs['pseudo']) ?></span>
  <?php endif; ?>
           
        </p>
        <p>
  <label for="inscription_email" class="obligatoire">Email:</label>
  <input type="email" name="inscription_email" id="inscription_email"
         value="<?= htmlspecialchars($valeurs['email']) ?>"
         required placeholder="Champ obligatoire">
  <?php if (isset($erreurs['email'])): ?>
    <br><span><?= htmlspecialchars($erreurs['email']) ?></span>
  <?php endif; ?>
</p>
<p>
<label for="inscription_motDePasse" class="obligatoire">Mot de passe:</label>
<input type="password" id="inscription_motDePasse" name="inscription_motDePasse" required minlength="8" maxlength="72" placeholder="Champ obligatoire">
<?php if (!empty($erreurs['motdepasse'])): ?>
            <br><span><?= htmlspecialchars($erreurs['motdepasse']) ?></span>
        <?php endif; ?>
    </p>
    <p>
<label for="inscription_motDePasse_confirmation" class="obligatoire">Confirmation: :</label>
<input type="password" id="inscription_motDePasse_confirmation" name="inscription_motDePasse_confirmation" required minlength="8" maxlength="72" placeholder="Champ obligatoire">
<?php if (!empty($erreurs['motdepasse_confirmation'])): ?>
            <br><span><?= htmlspecialchars($erreurs['motdepasse_confirmation']) ?></span>
        <?php endif; ?>
    </p>
    <button type="submit">Inscrire</button>
    
     <?php require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'footer.php';?>