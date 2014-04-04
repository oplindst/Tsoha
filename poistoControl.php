<?php
require 'libs/functions.php';
require "libs/models/pokemonlaji.php";

$id = (int)$_GET['id'];

Pokemonlaji::poistaKannasta($id);

header('Location: index.php');



