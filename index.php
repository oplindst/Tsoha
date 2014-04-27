<?php
require 'libs/functions.php';
require_once "libs/models/pokemonlaji.php";
if (!isset($_GET['order'])) {
    $order = 'id';
}
else {
    $order = $_GET['order'];
}
$pokemonit = Pokemonlaji::etsiKaikkiPokemonit($order);
if (isset($_SESSION["kirjautunut"])) {
    naytaNakyma('index.php', array('pokemonit' => $pokemonit));
}
else {
    naytaNakyma('login.php', array('pokemonit' => $pokemonit));
}