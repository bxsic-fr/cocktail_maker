<?php

    if (basename($_SERVER['PHP_SELF']) == "database_handler.php") {
        header("Location: ../index.php");
        exit();
    }

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $servername = "localhost";
    $env = parse_ini_file(".env");
    $login = $env["db_login"];
    $password = $env["db_password"];

    $dbname = "cocktail_maker";

    $conn = new mysqli($servername, $login, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    function get_random_cocktail() {
        global $conn;
        $sql = "SELECT * FROM cocktails ORDER BY RAND() LIMIT 1";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    function get_cocktail_by_name($name) {
        global $conn;
        $sql = "SELECT * FROM cocktails WHERE name = $name";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    function get_proccess_cocktail($name) {
        global $conn;
        $sql = "SELECT * FROM proccess WHERE cocktail_name = $name";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

?>