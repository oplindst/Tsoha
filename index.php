<?php

require 'libs/functions.php';
require_once "libs/models/pokemonlaji.php";

$pokemonit = Pokemonlaji::etsiKaikkiPokemonit();

if (kirjautunut()) {
    naytaNakyma('index.php', array('pokemonit' => $pokemonit));
}
else {
    naytaNakyma('login.php', array('pokemonit' => $pokemonit));
}