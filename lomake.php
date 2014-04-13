<?php

require 'libs/functions.php';
require_once "libs/models/pokemon.php";

kirjautunut();

$toiminto = $_GET['toiminto'];
$otsikko = '';
$submit = '';

if ($toiminto === 'muokkaa') {
    $otsikko = 'Muokkaa';
    $submit = 'Tallenna';
}

if ($toiminto === 'lisaa') {
    $otsikko = 'Lisää Pokemon';
    $submit = 'Lisää';
}

$laji = '';
$nimi = '';
$taso = '';
$hp = '';
$atk = '';
$def = '';
$spatk = '';
$spdef = '';
$spd = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pokemon = Pokemon::etsiPokemon($id);
    $laji = $pokemon->getLaji();
    $nimi = $pokemon->getName();
    $taso = $pokemon->getTaso();
    $hp = $pokemon->getHP();
    $atk = $pokemon->getAtk();
    $def = $pokemon->getDef();
    $spatk = $pokemon->getSpAtk();
    $spdef = $pokemon->getSpDef();
    $spd = $pokemon->getSpd();
}
naytaNakyma('omaLomake.php', array('otsikko' => $otsikko, 'submit' => $submit, 'laji' => $laji, 'nimi' => $nimi, 'taso' => $taso, 'hp' => $hp, 'atk' => $atk, 'def' => $def, 'spatk' => $spatk, 'spdef' => $spdef, 'spd' => $spd));

