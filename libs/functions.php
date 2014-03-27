<?php
session_start();

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    require 'views/pohja.php';
    exit();
}

function kirjautunut() {
    if (isset($_SESSION["kirjautunut"])) {
        $kayttaja = $_SESSION["kirjautunut"];
        return true;
    }
    header('Location: login.php');
    return false;
}
