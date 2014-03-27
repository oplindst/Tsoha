<?php

require_once "libs/tietokantayhteys.php"; 
require_once "libs/models/kayttaja.php";

$lista = Kayttaja::etsiKaikkiKayttajat();
?><!DOCTYPE HTML>
<html>
  <head><title>Listatesti</title></head>
  <body>
    <h1>Listaelementtitesti</h1>
    <ul>
    <?php foreach($lista as $asia) { ?>
        <li><?php echo $asia->getTunnus(); ?></li>
    <?php } ?>
    </ul>
  </body>
</html>

