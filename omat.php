<?php

require 'libs/functions.php';
require_once "libs/models/pokemon.php";

kirjautunut();
$omistaja = $_SESSION['kirjautunut'];
if (!isset($_GET['order'])) {
    $order = 'Laji';
}
else {
    $order = $_GET['order'];
}
$pokemonit = Pokemon::etsiKaikkiPokemonit($omistaja, $order);

naytaNakyma('omat.php', array('pokemonit' => $pokemonit));

