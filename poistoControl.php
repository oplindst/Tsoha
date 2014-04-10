<?php
require 'libs/functions.php';
require "libs/models/pokemonlaji.php";
kirjautunut();
$id = (int)$_GET['id'];

Pokemonlaji::poistaKannasta($id);

$_SESSION['ilmoitus'] = "Pokemonin poistaminen onnistui.";

header('Location: index.php');



