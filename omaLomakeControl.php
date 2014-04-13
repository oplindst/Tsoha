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

$toiminto = $_POST["toiminto"];

if ($lisattava->onkoKelvollinen()) {

    if ($toiminto === 'Tallenna') {
        $vanhaid = $_POST["vanhaid"];
        $lisattava->paivita($vanhaid);
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
    naytaNakyma('lajilomake.php', array('otsikko' => $otsikko, 'submit' => $submit, 'laji' => $laji, 'nimi' => $nimi, 'type1' => $type1, 'type2' => $type2, 'hp' => $hp, 'atk' => $atk, 'def' => $def, 'spatk' => $spatk, 'spdef' => $spdef, 'spd' => $spd, 'virheet' => $virheet));
}
