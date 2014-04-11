<?php

require 'libs/functions.php';
require "libs/models/kayttaja.php";

$tunnus = $_POST["Tunnus"];
$sala1 = $_POST["Sala1"];
$sala2 = $_POST["Sala2"];

$kayttaja = new Kayttaja();
$kayttaja->setTunnus($tunnus);
$kayttaja->setSalasana($sala1);
$kayttaja->setSala2($sala2);

$aiempi = Kayttaja::etsiKayttajaTunnuksilla($tunnus);

if ($kayttaja->onkoKelvollinen() && is_null($aiempi)) {
    $kayttaja->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Rekisteröinti onnistui";
    header('Location: index.php');
}
else {
    $virheet = $kayttaja->getVirheet();
    if (!is_null($aiempi)) {
        $virheet['on jo'] = 'Tunnus on jo käytössä.';
    }
    $tunnus = htmlspecialchars($tunnus);
    naytaNakyma('rekisteroityminen.php', array('Tunnus' => $tunnus, 'virheet' => $virheet));
}



