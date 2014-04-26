<?php

require 'libs/functions.php';
require_once "libs/models/tiimi.php";
require_once "libs/models/tiiminjasen.php";
require_once "libs/models/pokemon.php";
kirjautunut();
$tiimi_id = (int) $_POST['tiimi'];
$poke_id = (int) $_POST['pokemon'];
$param = array();
$param[] = $poke_id;
$param[] = $tiimi_id;
$jasen = new Tiiminjasen($param);
$jasen->onkoOlemassa();
$jasen->onkoTaynna();
if ($jasen->onkoKelvollinen()) {
    $jasen->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Pokemonin lisäys tiimiin onnistui.";

    header('Location: tiimit.php');
} else {
    $virheet = $jasen->getVirheet();
    $omistaja = $_SESSION['kirjautunut'];
    $tiimit = Tiimi::etsiKaikkiTiimit($omistaja);
    $pokemonit = Pokemon::etsiKaikkiPokemonit($omistaja, 'Laji');

    $tiimienjasenet = array();
    foreach ($tiimit as $tiimi) {
        $tiimi_id = $tiimi->getId();
        $tiiminjasenet = Tiiminjasen::etsiTiiminjasenet($tiimi_id);
        $tiimienjasenet[$tiimi_id] = Pokemon::haeTiiminPokemonit($tiiminjasenet);
    }

    naytaNakyma('tiimit.php', array('tiimit' => $tiimit, 'tiimienjasenet' => $tiimienjasenet, 'pokemonit' => $pokemonit, 'virheet' => $virheet));
}