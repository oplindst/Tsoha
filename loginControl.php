<?php
require 'libs/functions.php';
$sivu = 'login.php';
require 'libs/models/kayttaja.php';
require_once "libs/models/pokemonlaji.php";
$pokemonit = Pokemonlaji::etsiKaikkiPokemonit('id');

if (empty($_POST["salasana"]) && empty($_POST["tunnus"])) {
    
    naytaNakyma($sivu, array('pokemonit' => $pokemonit));
    
}

if (empty($_POST["tunnus"]) && !empty($_POST["salasana"])) {
    
    naytaNakyma($sivu, array('virhe' => "Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta.", 'pokemonit' => $pokemonit));
    
}

$tunnus = $_POST["tunnus"];

if (empty($_POST["salasana"]) && !empty($_POST["tunnus"])) {
    
    naytaNakyma($sivu, array('virhe' => "Kirjautuminen epäonnistui! Et antanut salasanaa.", 'pokemonit' => $pokemonit));
    
}

$salasana = $_POST["salasana"];

$kayttaja = Kayttaja::etsiKayttajaTunnuksilla($tunnus, $salasana);

if (!$kayttaja == null) {
    $id = $kayttaja->getId();
    $_SESSION['kirjautunut'] = $id;
    header('Location: index.php');
} else {
    
    naytaNakyma($sivu, array('pokemonit' => $pokemonit, 'kayttaja' => $tunnus, 'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.", request));
}


