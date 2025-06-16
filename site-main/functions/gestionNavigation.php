<?php 
require_once __DIR__ .DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';
function gestionNavigation(){
 // создаем массив навигации 
 $pages = [
    "Accueil"=>BASE_URL . "/index.php",
    "Contact"=> BASE_URL . "/pages/contact.php",
    "Connexion"=>BASE_URL . "/pages/connexion.php"
 ] ;
 $currentPage = basename($_SERVER['PHP_SELF']);
 echo '<nav>';
 echo '<ul>';
foreach ($pages as $pageName =>$pageURL){
    $activeClass =($currentPage == basename($pageURL))?'class="active"':'';
    // Выводим элемент списка с соответствующим классом для активной страницы
    echo "<li $activeClass><a href=\"$pageURL\">$pageName</a></li>";

}
echo '</ul>';
echo '</nav>';
}
?>