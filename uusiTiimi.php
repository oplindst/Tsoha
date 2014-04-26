<?php

require 'libs/functions.php';
require "libs/models/tiimi.php";

$nimi = $_POST["Nimi"];
$omistaja = $_SESSION['kirjautunut'];

$tiimi = new Tiimi();
$tiimi->setNimi($nimi);
if ($tiimi->onkoKelvollinen()) {
    $tiimi->lisaaKantaan($omistaja);
    header('Location: tiimit.php');
}
else {
    $virheet = $tiimi->getVirheet();
    $nimi = htmlspecialchars($nimi);
    $tiimit = Tiimi::etsiKaikkiTiimit($omistaja);
    naytaNakyma('tiimit.php', array('tiimit' => $tiimit, 'virheet' => $virheet, 'nimi' => $nimi));
}
?>
