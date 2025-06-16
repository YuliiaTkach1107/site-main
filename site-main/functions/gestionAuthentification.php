<?php
function connecterUtilisateur($utilisateurId){
    if (session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }
     $_SESSION['utilisateurId']=$utilisateurId;

}
function estConnectee(){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['utilisateurId']);
}
function deconnecterUtilisateur(){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    unset($_SESSION['utilisateurId']);
}
?>