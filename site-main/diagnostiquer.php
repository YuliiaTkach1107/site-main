<?php
// Forçage local des paramètres
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Affichage des constantes d’erreur
echo "<h2>Diagnostic des erreurs PHP</h2>";

// Fichier php.ini utilisé
echo "<p><b>Fichier php.ini utilisé :</b> " . php_ini_loaded_file() . "</p>";

// Répertoire où PHP cherche des .ini additionnels
echo "<p><b>Dossier de scan .ini :</b> " . php_ini_scanned_files() . "</p>";

// Valeurs courantes
echo "<p><b>display_errors :</b> " . ini_get('display_errors') . "</p>";
echo "<p><b>display_startup_errors :</b> " . ini_get('display_startup_errors') . "</p>";
echo "<p><b>error_reporting :</b> " . error_reporting() . " (attendu : 32767 pour E_ALL)</p>";

// Analyse bit à bit des erreurs activées
function etat($flag) {
    return (error_reporting() & $flag) ? '✔️' : '❌';
}

echo "<h3>Détails des types d’erreurs activés :</h3>";
echo "<ul>";
echo "<li>E_ERROR : " . etat(E_ERROR) . "</li>";
echo "<li>E_WARNING : " . etat(E_WARNING) . "</li>";
echo "<li>E_PARSE : " . etat(E_PARSE) . "</li>";
echo "<li>E_NOTICE : " . etat(E_NOTICE) . "</li>";
echo "<li>E_DEPRECATED : " . etat(E_DEPRECATED) . "</li>";
echo "<li>E_USER_NOTICE : " . etat(E_USER_NOTICE) . "</li>";
echo "<li>E_STRICT : " . (defined('E_STRICT') ? etat(E_STRICT) : 'Non défini') . "</li>";
echo "</ul>";

// Test : provoque une erreur de constante
echo "<h3>Test d’erreur :</h3>";
echo "Constante inexistante : ";
echo CONSTANTE_INEXISTANTE; // Génère une E_NOTICE

?>
