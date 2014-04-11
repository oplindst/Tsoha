<?php

require 'libs/functions.php';
require "libs/models/pokemonlaji.php";

$id = $_POST["ID"];
$nimi = $_POST["Nimi"];
$type1 = $_POST["type1"];
$type2 = $_POST["type2"];
$hp = $_POST["HP"];
$atk = $_POST["Attack"];
$def = $_POST["Defense"];
$spatk = $_POST["SpAttack"];
$spdef = $_POST["SpDefense"];
$spd = $_POST["Speed"];

$lisattava = new Pokemonlaji();
$lisattava->setId($id);
$lisattava->setName($nimi);
$lisattava->setType1($type1);
$lisattava->setType2($type2);
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
        $lisattava->lisaaKantaan();
        $_SESSION['ilmoitus'] = "Pokemonin lisäys onnistui.";
    }
    header('Location: index.php');
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
    naytaNakyma('lajilomake.php', array('otsikko' => $otsikko, 'submit' => $submit, 'id' => $id, 'nimi' => $nimi, 'type1' => $type1, 'type2' => $type2, 'hp' => $hp, 'atk' => $atk, 'def' => $def, 'spatk' => $spatk, 'spdef' => $spdef, 'spd' => $spd, 'virheet' => $virheet));
}