<?php

require 'libs/functions.php';
require_once "libs/models/pokemonlaji.php";

kirjautunut();

$toiminto = $_GET['toiminto'];
$otsikko = '';
$submit = '';

if ($toiminto === 'haku') {
    $otsikko = 'Haku';
    $submit = 'Hae';
}

if ($toiminto === 'muokkaa') {
    $otsikko = 'Muokkaa';
    $submit = 'Tallenna';
}

if ($toiminto === 'lisaa') {
    $otsikko = 'Lisää Pokemon';
    $submit = 'Lisää';
}

$id = '';
$nimi = '';
$type1 = 'Normal';
$type2 = '';
$hp = '';
$atk = '';
$def = '';
$spatk = '';
$spdef = '';
$spd = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pokemon = Pokemonlaji::etsiPokemon($id);
    $nimi = $pokemon->getName();
    $type1 = $pokemon->getType1();
    $type2 = $pokemon->getType2();
    $hp = $pokemon->getHP();
    $atk = $pokemon->getAtk();
    $def = $pokemon->getDef();
    $spatk = $pokemon->getSpAtk();
    $spdef = $pokemon->getSpDef();
    $spd = $pokemon->getSpd();
}
naytaNakyma('lajilomake.php', array('otsikko' => $otsikko, 'submit' => $submit, 'id' => $id, 'nimi' => $nimi, 'type1' => $type1, 'type2' => $type2, 'hp' => $hp, 'atk' => $atk, 'def' => $def, 'spatk' => $spatk, 'spdef' => $spdef, 'spd' => $spd));


