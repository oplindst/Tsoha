<?php
require 'libs/functions.php';
require "libs/models/pokemon.php";
kirjautunut();
$id = (int)$_GET['id'];

Pokemon::poistaKannasta($id);

$_SESSION['ilmoitus'] = "Pokemonin poistaminen onnistui.";

header('Location: omat.php');