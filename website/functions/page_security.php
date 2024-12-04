<?php

    if (basename($_SERVER['PHP_SELF']) == "page_security.php") {
        header("Location: ../index.php");
        exit();
    }

    function securestring($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

?>