<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'gestionSession.php';
$pageTitre='Contact';
$metaDescription="Page de contact. Vous pouvez nous écrire ici.";
require_once __DIR__. DIRECTORY_SEPARATOR . '..' .DIRECTORY_SEPARATOR .'includes'.DIRECTORY_SEPARATOR.'header.php';
initialiserSession();
$erreurs = $_SESSION['formErreurs'] ?? [];
$valeurs =  $_SESSION['formValeurs'] ?? [
    'nom'    => '',
    'prenom' => '',
    'email'  => '',
    'message'=> ''
];
unset($_SESSION['formErreurs'], $_SESSION['formValeurs']);
?>
<h2>Page de contact</h2>

<form method="post" action="../controllers/contactController.php" novalidate>
<p>
            <label for="nom" class="obligatoire">Nom:</label>
            <input type="text" name="nom" id="nom" placeholder="Champ obligatoire" required/ minlength="2" maxlength="255"
            value="<?= htmlspecialchars($valeurs['nom']) ?>"
               class="<?= isset($erreurs['nom']) ? 'champ-erreur' : '' ?>">
        <?php if (isset($erreurs['nom'])): ?>
           <br> <span class="texte-erreur"><?= htmlspecialchars($erreurs['nom']) ?></span>
        <?php endif; ?>
           
        </p>
<p>
                <label for="prenom">Prénom:</label>
                <input type="text" name ="prenom" id="prenom" minlength="2" maxlength="255" 
                value="<?= htmlspecialchars($valeurs['prenom']) ?>"
               class="<?= isset($erreurs['prenom']) ? 'champ-erreur' : '' ?>">
        <?php if (isset($erreurs['prenom'])): ?>
            <br> <span class="texte-erreur"><?= htmlspecialchars($erreurs['prenom']) ?></span>
        <?php endif; ?>
            </p>
<p>
<label for="email" class="obligatoire">e-Mail:</label>
                <input type="email" name="email" id="email" placeholder="Champ obligatoire" required/ 
                value="<?= htmlspecialchars($valeurs['email']) ?>"
               class="<?= isset($erreurs['email']) ? 'champ-erreur' : '' ?>">
        <?php if (isset($erreurs['email'])): ?>
            <br> <span class="texte-erreur"><?= htmlspecialchars($erreurs['email']) ?></span>
        <?php endif; ?>
            </p>
<p>
<label for="message" class="obligatoire">Message:</label>
    <textarea id="message" name="message" required minlength="10" maxlength="3000" placeholder="Champ obligatoire" 
    class="<?= isset($erreurs['message']) ? 'champ-erreur' : '' ?>"><?= htmlspecialchars($valeurs['message']) ?></textarea>
        <?php if (isset($erreurs['message'])): ?>
            <br> <span class="texte-erreur"><?= htmlspecialchars($erreurs['message']) ?></span>
        <?php endif; ?>
    </textarea>
    </p>
    <button type="submit">Envoyer</button>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p class="message-flash <?= $formValide ? 'ok' : 'err' ?>">
            <?= $formValide ? 'Formulaire envoyé avec succès !' : 'Formulaire non envoyé !' ?>
        </p>
    <?php endif; ?>

    <?php require_once __DIR__. DIRECTORY_SEPARATOR . '..' .DIRECTORY_SEPARATOR .'includes'.DIRECTORY_SEPARATOR.'footer.php';?>