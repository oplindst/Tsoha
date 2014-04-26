<?php
require 'libs/functions.php';
require "libs/models/tiimi.php";
kirjautunut();
$id = (int)$_POST['tiimi'];

Tiimi::poistaKannasta($id);

$_SESSION['ilmoitus'] = "Tiimin poistaminen onnistui.";

header('Location: tiimit.php');