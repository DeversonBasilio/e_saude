<?php
    session_start();

    $serverName = secrets.SERVER_NAME_SECRET;
    $Database   = secrets.SERVER_DATABASE;
    $user       = secrets.SERVER_USER;
    $pass       = secrets.SERVER_PASS;
    $charset    = "UTF-8";

    define('ENVIRONMENT', 'dev');

    if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    }

    $conn = new mysqli($serverName, $user, $pass,$Database);

    if ($conn->connect_error) {
        define('CONEXAO', 'no');
        die($conn->connect_error);
    } else {
        define('CONEXAO', 'yes');
    }   
?>
