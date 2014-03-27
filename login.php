<?php

$sivu = 'kirjautuminen.php';

//Pohjatiedosto huolehtii sekä HTML-rungon, 
//että oikean näkymän näyttämisestä
require 'views/pohja.php';
require 'libs/functions.php';

if (empty($_POST["tunnus"]) || empty($_POST["salasana"])) {
    /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
    naytaNakyma("login");
    exit(); // Lopetetaan suoritus tähän. Kutsun voi sijoittaa myös naytaNakyma-funktioon, niin sitä ei tarvitse toistaa joka paikassa
}

$kayttaja = $_POST["tunnus"];
$salasana = $_POST["salasana"];

/* Tarkistetaan onko parametrina saatu oikeat tunnukset */
if ("O-P" == $kayttaja && "bulbasaur" == $salasana) {
    /* Jos tunnus on oikea, ohjataan käyttäjä sopivalla HTTP-otsakkeella kissalistaan. */
    header('Location: etusivu.php');
} else {
    /* Väärän tunnuksen syöttänyt saa eteensä kirjautumislomakkeen. */
    naytaNakyma("login");
}
