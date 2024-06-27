<?php
spl_autoload_register(function ($class) {
    $file = $_SERVER['DOCUMENT_ROOT'] . '/SVW/class/' . $class . '.php';
    if (file_exists($file)) {
        include $file;
    }
});

// Start sesiunea și include alte fișiere necesare
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '../SVW/login/auth.php';
?>
