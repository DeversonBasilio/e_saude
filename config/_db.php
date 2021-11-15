<?php
    session_start();

    $serverName = "sql396.main-hosting.eu";
    $Database   = "u121811460_saudebr";
    $user       = "u121811460_db_admin";
    $pass       = "Teorema7.7";
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