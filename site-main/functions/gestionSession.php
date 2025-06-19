<?php
function initialiserSession (){
    ini_set('session.use_strict_mode', 1);
    session_set_cookie_params([
        'httponly' => true,
        'secure' => false, 
        'samesite' => 'Lax'
    ]);
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }    
}
function detruireSession(){
    if(session_status()===PHP_SESSION_ACTIVE){
        $_SESSION = [];

        if(ini_get("session.use_cookies")){
            $params = session_get_cookie_params();
            setcookie(session_name(),'',time()-42000,
            $params["path"],$params["domain"],
            $params['secure'],$params['httponly']);
        }
        session_destroy();
    }
}

?>
