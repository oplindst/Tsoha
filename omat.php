<?php
require 'libs/functions.php';
require_once "libs/models/pokemon.php";

kirjautunut();
$omistaja = $_SESSION['kirjautunut'];
$pokemonit = Pokemon::etsiKaikkiPokemonit($omistaja);

naytaNakyma('omat.php', array('pokemonit' => $pokemonit));

