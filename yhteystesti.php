<?php
//Tietokannan tunnukset:
$tunnus = "oplindst";
$salasana= "ecd47644d4dabd2a";

//Yhteysolion luominen
$yhteys = new PDO("pgsql:host=localhost;port=5432;dbname=$tunnus", $tunnus, $salasana);

//Seuravaa komento pyytää PDO:ta tuottamaan poikkeuksen aina kun jossain on virhe.
//Kannattaa käyttää, oletuksena luokka ei raportoi virhetiloja juuri mitenkään!
$yhteys->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = "select 1+1 as two";
$kysely = $yhteys->prepare($sql);


if ($kysely->execute()) {
  $kakkonen = $kysely->fetchColumn();
  var_dump($kakkonen);
}

