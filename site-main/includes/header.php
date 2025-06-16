<?php

 require_once __DIR__.DIRECTORY_SEPARATOR . '..' .DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';

BASE_URL;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $metaDescription ?>">
    <title><?php echo $pageTitre; ?></title>
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/assets/css.css?v=<?= time() ?>">
</head>
<body>
    <header>
    <?php 
    require_once __DIR__. DIRECTORY_SEPARATOR . '..' .DIRECTORY_SEPARATOR.'functions'.DIRECTORY_SEPARATOR.'gestionNavigation.php'; 
    ?>
     <nav><ul>
    <li><a href='<?php echo BASE_URL ?>index.php'>Accueil</a></li>
    <li><a href='<?php echo BASE_URL ?>pages/contact.php'>Contacts</a></li>
    <li><a href='<?php echo BASE_URL ?>pages/connexion.php'>Connexion</a></li>
    </ul></nav>
    </header>
    <main>