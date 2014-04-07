<?php

require 'libs/functions.php';
require "libs/models/pokemonlaji.php";

$nimi = trim($_POST["Nimi"]);
$type1 = trim($_POST["type1"]);
$type2 = trim($_POST["type2"]);
$hp = trim($_POST["HP"]);
$atk = trim($_POST["Attack"]);
$def = trim($_POST["Defense"]);
$spatk = trim($_POST["SpAttack"]);
$spdef = trim($_POST["SpDefense"]);
$spd = trim($_POST["Speed"]);

$pokemonit = Pokemonlaji::etsiPokemoneja($nimi, $type1, $type2, $hp, $atk, $def, $spatk, $spdef, $spd);

naytaNakyma('lajihakutulos.php', array('pokemonit' => $pokemonit));

