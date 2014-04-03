<?php
require 'libs/functions.php';
require_once "libs/models/pokemonlaji.php";

kirjautunut();

$pokemonit = Pokemonlaji::etsiKaikkiPokemonit();

naytaNakyma('index.php', array('pokemonit' => $pokemonit));