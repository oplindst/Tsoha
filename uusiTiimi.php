<?php

require 'libs/functions.php';
require "libs/models/tiimi.php";
require_once "libs/models/tiiminjasen.php";
require_once "libs/models/pokemon.php";

$nimi = $_POST["Nimi"];
$omistaja = $_SESSION['kirjautunut'];

$tiimi = new Tiimi();
$tiimi->setNimi($nimi);
if ($tiimi->onkoKelvollinen()) {
    $tiimi->lisaaKantaan($omistaja);
    $_SESSION['ilmoitus'] = "Tiimiin luominen onnistui.";
    header('Location: tiimit.php');
} else {
    $virheet = $tiimi->getVirheet();
    $nimi = htmlspecialchars($nimi);
    $tiimit = Tiimi::etsiKaikkiTiimit($omistaja);
    $pokemonit = Pokemon::etsiKaikkiPokemonit($omistaja, 'Laji');

    $tiimienjasenet = array();
    foreach ($tiimit as $tiimi) {
        $tiimi_id = $tiimi->getId();
        $tiiminjasenet = Tiiminjasen::etsiTiiminjasenet($tiimi_id);
        $tiimienjasenet[$tiimi_id] = Pokemon::haeTiiminPokemonit($tiiminjasenet);
    }

    naytaNakyma('tiimit.php', array('tiimit' => $tiimit, 'tiimienjasenet' => $tiimienjasenet, 'pokemonit' => $pokemonit, 'virheet' => $virheet, 'nimi' => $nimi));
}
?>
