<?php

require_once 'libs/functions.php';
require_once "libs/models/pokemonlaji.php";

$pokemonit = Pokemonlaji::etsiKaikkiPokemonit();

if ($_SESSION['kirjautunut']) {
    header('Location: etusivu.php');
}

naytaNakyma('login.php', array('pokemonit' => $pokemonit));
