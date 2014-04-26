<?php

require 'libs/functions.php';
require_once "libs/models/tiimi.php";
require_once "libs/models/tiiminjasen.php";
require_once "libs/models/pokemon.php";

kirjautunut();
$omistaja = $_SESSION['kirjautunut'];
$tiimit = Tiimi::etsiKaikkiTiimit($omistaja);
$pokemonit = Pokemon::etsiKaikkiPokemonit($omistaja, 'Laji');

$tiimienjasenet = array();
foreach($tiimit as $tiimi) {
    $tiimi_id = $tiimi->getId();
    $tiiminjasenet = Tiiminjasen::etsiTiiminjasenet($tiimi_id);
    $tiimienjasenet[$tiimi_id] = Pokemon::haeTiiminPokemonit($tiiminjasenet);
}

naytaNakyma('tiimit.php', array('tiimit' => $tiimit, 'tiimienjasenet' => $tiimienjasenet, 'pokemonit' => $pokemonit));
