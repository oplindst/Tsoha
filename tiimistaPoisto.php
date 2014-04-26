<?php
require 'libs/functions.php';
require "libs/models/tiiminjasen.php";
kirjautunut();
$poke_id = (int)$_GET['poke'];
$tiimi_id = (int)$_GET['tiimi'];

Tiiminjasen::poistaKannasta($tiimi_id, $poke_id);

$_SESSION['ilmoitus'] = "Pokemonin poistaminen tiimistä onnistui.";

header('Location: tiimit.php');
