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
$ivs = array(0,0,0,0,0,0);
$evs = array(0,0,0,0,0,0);
$nature = 'Hardy';
$kommentti = '';
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
    $ivs = $pokemon->getIVs();
    $evs = $pokemon->getEVs();
    $nature = $pokemon->getNature();
    $kommentti = $pokemon->getKommentti();
}

$ivlabels = array('HPIV', 'AttackIV', 'DefenseIV', 'SpAttackIV', 'SpDefenseIV', 'SpeedIV');
$evlabels = array('HPEV', 'AttackEV', 'DefenseEV', 'SpAttackEV', 'SpDefenseEV', 'SpeedEV');
$ivvalues = array_combine($ivlabels, $ivs);
$evvalues = array_combine($evlabels, $evs);
$natures = array('Hardy', 'Lonely', 'Brave', 'Adamant', 'Naughty', 'Bold', 'Docile', 'Relaxed', 'Impish', 'Lax', 'Timid', 'Hasty', 'Serious', 'Jolly', 'Naive', 'Modest', 'Mild', 'Quiet', 'Bashful', 'Rash', 'Calm', 'Gentle', 'Sassy', 'Careful', 'Quirky');
naytaNakyma('omaLomake.php', array('otsikko' => $otsikko, 'submit' => $submit, 'laji' => $laji, 'nimi' => $nimi, 'taso' => $taso, 'hp' => $hp, 'atk' => $atk, 'def' => $def, 'spatk' => $spatk, 'spdef' => $spdef, 'spd' => $spd, 'id' => $id, 'nature' => $nature, 'kommentti' => $kommentti, 'ivvalues' => $ivvalues, 'evvalues' => $evvalues, 'natures' => $natures));

