<?php

$sessionName = "sessionToken";
$secretName = "secretToken";
$usrName = "username";

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'logout':
                logout();
                break;
        }
    }

    function logout() {
        setcookie($sessionName, "", time()+60*60*24*364, "/", "kodos.dev", TRUE);
        setcookie($secretName, "", time()+60*60*24*364, "/", "kodos.dev", TRUE);
        setcookie($usrName, "", time()+60*60*24*364, "/", "kodos.dev", TRUE);
        exit;
    }
?>