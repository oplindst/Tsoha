<?php

class Tiimi {

    private $Id;
    private $Nimi;
    private $Omistaja;
    private $virheet = array();

    public function __construct($id, $nimi, $omistaja) {
        $this->Id = $id;
        $this->Nimi = $nimi;
        $this->Omistaja = $omistaja;
    }

    public function getId() {
        return $this->Id;
    }

    public function getNimi() {
        return $this->Nimi;
    }

    public function getOmistaja() {
        return $this->Omistaja;
    }

    public function setId($id) {
        $this->Id = $id;
    }

    public function setNimi($nimi) {
        $this->Nimi = $nimi;

        if (trim($nimi) === '') {
            $this->virheet['nimi'] = "Tiimin nimi ei saa olla tyhjä";
        } else if (htmlspecialchars($nimi) !== $nimi) {
            $this->virheet['nimi'] = "Erikoismerkit kielletty";
        } else if (strlen($nimi) > 15) {
            $this->virheet['nimi'] = "Nimen pitää olla 15 merkkiä tai alle.";
        } else {
            unset($this->virheet['nimi']);
        }
    }

    public static function etsiKaikkiTiimit($omistaja) {
        require_once "libs/tietokantayhteys.php";
        $sql = "select * from Tiimi where Omistaja = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($omistaja));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tiimi = new Tiimi();
            $tiimi->setId($tulos->id);
            $tiimi->setNimi($tulos->nimi);

            $tulokset[] = $tiimi;
        }
        return $tulokset;
    }

    public function lisaaKantaan($omistaja) {
        require_once "libs/tietokantayhteys.php";
        $sql = "Insert into Tiimi(Nimi, Omistaja) Values (?,?)";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->Nimi, $omistaja));
    }
    
    public static function poistaKannasta($id) {
        require_once "libs/tietokantayhteys.php";
        $sql = "DELETE FROM Tiimi WHERE ID = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
    }

    public function onkoKelvollinen() {
        return empty($this->virheet);
    }

    public function getVirheet() {
        return $this->virheet;
    }

}

?>