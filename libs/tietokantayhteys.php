<?php

class Yhteys {

    function getTietokantayhteys() {
        static $yhteys = null; //Muuttuja, jonka sisältö säilyy getTietokantayhteys-kutsujen välillä.

        if ($yhteys === null) {

            //Yhteysolion luominen
            $yhteys = new PDO("pgsql:");

            //Seuravaa komento pyytää PDO:ta tuottamaan poikkeuksen aina kun jossain on virhe.
            //Kannattaa käyttää, oletuksena luokka ei raportoi virhetiloja juuri mitenkään!
            $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $yhteys;
    }

}
