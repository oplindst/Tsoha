<?php

require 'libs/functions.php';
require "libs/models/pokemon.php";

$laji = $_POST["ID"];
$nimi = $_POST["Nimi"];
$taso = $_POST["Taso"];
$hp = $_POST["HP"];
$atk = $_POST["Attack"];
$def = $_POST["Defense"];
$spatk = $_POST["SpAttack"];
$spdef = $_POST["SpDefense"];
$spd = $_POST["Speed"];
$ivs = array($_POST["HPIV"], $_POST["AttackIV"], $_POST["DefenseIV"], $_POST["SpAttackIV"], $_POST["SpDefenseIV"], $_POST["SpeedIV"]);
$evs = array($_POST["HPEV"], $_POST["AttackEV"], $_POST["DefenseEV"], $_POST["SpAttackEV"], $_POST["SpDefenseEV"], $_POST["SpeedEV"]);
$nature = $_POST["Nature"];
$kommentti = $_POST["Kommentti"];

$lisattava = new Pokemon();
$lisattava->setLaji($laji);
$lisattava->setName($nimi);
$lisattava->setTaso($taso);
$lisattava->setHP($hp);
$lisattava->setAtk($atk);
$lisattava->setDef($def);
$lisattava->setSpAtk($spatk);
$lisattava->setSpDef($spdef);
$lisattava->setSpd($spd);
$lisattava->setIVs($ivs);
$lisattava->setEVs($evs);
$lisattava->setNature($nature);
$lisattava->setKommentti($kommentti);

$toiminto = $_POST["toiminto"];

if ($lisattava->onkoKelvollinen()) {

    if ($toiminto === 'Tallenna') {
        $id = $_POST["id"];
        $lisattava->paivita($id);
        $_SESSION['ilmoitus'] = "Pokemonin muokkaus onnistui.";
    }

    if ($toiminto === 'Lisää') {
        $id = $_SESSION['kirjautunut'];
        $lisattava->lisaaKantaan($id);
        $_SESSION['ilmoitus'] = "Pokemonin lisäys onnistui.";
    }
    header('Location: omat.php');
} else {
    if ($toiminto === 'Tallenna') {
        $otsikko = 'Muokkaa';
        $submit = 'Tallenna';
    }

    if ($toiminto === 'Lisää') {
        $otsikko = 'Lisää Pokemon';
        $submit = 'Lisää';
    }
    $id = $_POST["vanhaid"];
    $virheet = $lisattava->getVirheet();
    $nimi = htmlspecialchars($nimi);
    $ivlabels = array('HPIV', 'AttackIV', 'DefenseIV', 'SpAttackIV', 'SpDefenseIV', 'SpeedIV');
    $evlabels = array('HPEV', 'AttackEV', 'DefenseEV', 'SpAttackEV', 'SpDefenseEV', 'SpeedEV');
    $ivvalues = array_combine($ivlabels, $ivs);
    $evvalues = array_combine($evlabels, $evs);
    $natures = array('Hardy', 'Lonely', 'Brave', 'Adamant', 'Naughty', 'Bold', 'Docile', 'Relaxed', 'Impish', 'Lax', 'Timid', 'Hasty', 'Serious', 'Jolly', 'Naive', 'Modest', 'Mild', 'Quiet', 'Bashful', 'Rash', 'Calm', 'Gentle', 'Sassy', 'Careful', 'Quirky');
    naytaNakyma('omaLomake.php', array('otsikko' => $otsikko, 'submit' => $submit, 'laji' => $laji, 'nimi' => $nimi, 'taso' => $taso, 'hp' => $hp, 'atk' => $atk, 'def' => $def, 'spatk' => $spatk, 'spdef' => $spdef, 'spd' => $spd, 'id' => $id, 'ivvalues' => $ivvalues, 'evvalues' => $evvalues, 'natures' => $natures, 'virheet' => $virheet, 'nature' => $nature, 'kommentti' => $kommentti));
}
