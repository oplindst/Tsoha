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

if ($toiminto === 'haku') {
    $otsikko = 'Haku';
    $submit = 'Hae';
}

if ($toiminto === 'Tallenna') {
    $vanhaid = $_POST["vanhaid"];
    $lisattava->paivita($vanhaid);
}

if ($toiminto === 'Lisää') {
    $lisattava->lisaaKantaan();
}

header('Location: index.php');