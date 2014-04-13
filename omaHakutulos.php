<?php

require 'libs/functions.php';
require "libs/models/pokemon.php";

$nimi = trim($_POST["Nimi"]);
$type1 = trim($_POST["type1"]);
$type2 = trim($_POST["type2"]);
$hp = trim($_POST["HP"]);
$atk = trim($_POST["Attack"]);
$def = trim($_POST["Defense"]);
$spatk = trim($_POST["SpAttack"]);
$spdef = trim($_POST["SpDefense"]);
$spd = trim($_POST["Speed"]);

$testi = new Pokemon();
$testi->setHP($hp);
$testi->setAtk($atk);
$testi->setDef($def);
$testi->setSpAtk($spatk);
$testi->setSpDef($spdef);
$testi->setSpd($spd);
$testi->poistaVirheitaHakuaVarten();
$id = $_SESSION['kirjautunut'];

if ($testi->onkoKelvollinen()) {
    $pokemonit = Pokemon::etsiPokemoneja($nimi, $type1, $type2, $hp, $atk, $def, $spatk, $spdef, $spd, $id);
    if (empty($pokemonit)) {
        $virhe = 'Ei hakutuloksia.';
        $nimi = htmlspecialchars($nimi);
        naytaNakyma('omaHaku.php', array('nimi' => $nimi, 'type1' => $type1, 'type2' => $type2, 'hp' => $hp, 'atk' => $atk, 'def' => $def, 'spatk' => $spatk, 'spdef' => $spdef, 'spd' => $spd, 'virhe' => $virhe));
    } else {
        naytaNakyma('omaHakutulos.php', array('pokemonit' => $pokemonit));
    }
}
else {
    $virheet = $testi->getVirheet();
    $nimi = htmlspecialchars($nimi);
    naytaNakyma('omaHaku.php', array('nimi' => $nimi, 'type1' => $type1, 'type2' => $type2, 'hp' => $hp, 'atk' => $atk, 'def' => $def, 'spatk' => $spatk, 'spdef' => $spdef, 'spd' => $spd, 'virheet' => $virheet));
}
