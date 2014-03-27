<?php

class Kayttaja {

    private $Id;
    private $Tunnus;
    private $Salasana;

    public function __construct($id, $tunnus, $salasana) {
        $this->Id = $id;
        $this->Tunnus = $tunnus;
        $this->Salasana = $salasana;
    }

    public function getId() {
        return $this->Id;
    }

    public function getTunnus() {
        return $this->Tunnus;
    }

    public function getSalasana() {
        return $this->Salasana;
    }

    public function setId($id) {
        $this->Id = $id;
    }

    public function setTunnus($tunnus) {
        $this->Tunnus = $tunnus;
    }

    public function setSalasana($salasana) {
        $this->Salasana = $salasana;
    }

    public static function etsiKaikkiKayttajat() {
        require_once "libs/tietokantayhteys.php";
        $sql = "select id, tunnus, salasana from kayttaja";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kayttaja = new Kayttaja();
            $kayttaja->setId($tulos->id);
            $kayttaja->setTunnus($tulos->tunnus);
            $kayttaja->setSalasana($tulos->salasana);
            
            $tulokset[] = $kayttaja;
        }
        return $tulokset;
    }

    public static function etsiKayttajaTunnuksilla($kayttaja, $salasana) {
        require_once "libs/tietokantayhteys.php";
        $sql = "SELECT * from kayttaja where tunnus = ? AND salasana = ? LIMIT 1";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kayttaja, $salasana));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $kayttaja = new Kayttaja();
            $kayttaja->setId($tulos->id);
            $kayttaja->setTunnus($tulos->tunnus);
            $kayttaja->setSalasana($tulos->salasana);

            return $kayttaja;
        }
    }

}

?>
