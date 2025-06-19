
<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'gestionSession.php';
initialiserSession();
$nom = $_POST['nom'] ?? '';
$prenom = $_POST['prenom'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

$erreurs = [];

// Validation
if (!$nom || strlen($nom) < 2 || strlen($nom) > 255) {
    $erreurs['nom'] = "Le nom doit contenir entre 2 et 255 caractères.";
}
if ($prenom && (strlen($prenom) < 2 || strlen($prenom) > 255)) {
    $erreurs['prenom'] = "Le prénom doit contenir entre 2 et 255 caractères.";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erreurs['email'] = "Adresse email invalide.";
}
if (!$message || strlen($message) < 10 || strlen($message) > 3000) {
    $erreurs['message'] = "Le message doit contenir entre 10 et 3000 caractères.";
}

// Traitement
if (empty($erreurs)) {
    $to = 'ulatkachenko1107@gmail.com'; // ← замени на свою почту

    $subject = 'Projet Framework - Formulaire de contact';

    $htmlMessage = "
    <html>
        <head><meta charset='UTF-8'></head>
        <body>
            <h2>Message de contact</h2>
            <p><strong>Nom :</strong> " . htmlspecialchars($nom) . "</p>
            <p><strong>Prénom :</strong> " . htmlspecialchars($prenom) . "</p>
            <p><strong>Email :</strong> " . htmlspecialchars($email) . "</p>
            <p><strong>Message :</strong><br/>" . nl2br(htmlspecialchars($message)) . "</p>
        </body>
    </html>";

    $headers = "From: {$prenom} {$nom} <{$email}>\r\n";
    $headers .= "Reply-To: {$email}\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "Content-Transfer-Encoding: 8bit\r\n";

    if (mail($to, $subject, $htmlMessage, $headers)) {
        $_SESSION['formValide'] = true;
    } else {
        $_SESSION['formValide'] = false;
}
header('Location: ../pages/contact.php');
exit;
} else {
    $_SESSION['formErreurs'] = $erreurs;
    $_SESSION['formValeurs'] = $_POST;
    header('Location: ../pages/contact.php');
    exit;
    }


?>
