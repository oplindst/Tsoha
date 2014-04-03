<?php
require 'libs/functions.php';
$sivu = 'login.php';
require 'libs/models/kayttaja.php';

if (empty($_POST["salasana"]) && empty($_POST["tunnus"])) {
    
    naytaNakyma($sivu);
    
}

if (empty($_POST["tunnus"]) && !empty($_POST["salasana"])) {
    
    naytaNakyma($sivu, array('virhe' => "Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta."));
    
}

$tunnus = $_POST["tunnus"];

if (empty($_POST["salasana"]) && !empty($_POST["tunnus"])) {
    
    naytaNakyma($sivu, array('virhe' => "Kirjautuminen epäonnistui! Et antanut salasanaa."));
    
}

$salasana = $_POST["salasana"];

$kayttaja = Kayttaja::etsiKayttajaTunnuksilla($tunnus, $salasana);

if (!$kayttaja == null) {
    $_SESSION['kirjautunut'] = $kayttaja;
    header('Location: index.php');
} else {
    /* Väärän tunnuksen syöttänyt saa eteensä kirjautumislomakkeen. */
    naytaNakyma($sivu, array('kayttaja' => $tunnus, 'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.", request));
}


