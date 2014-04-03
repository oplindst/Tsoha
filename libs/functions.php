<?php
session_start();

require_once "libs/tietokantayhteys.php";

function haeTietokannasta($sql) {
    $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
    $kysely->execute();
    return $kysely;
}

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
