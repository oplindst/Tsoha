<?php

class Tiiminjasen {

    private $Poke_id;
    private $Tiimi_id;
    private $virheet = array();

    public function __construct($param) {
        $this->Poke_id = $param[0];
        $this->Tiimi_id = $param[1];
    }
    
    public function setPoke_id($id) {
        $this->Poke_id = $id;
    }
    
    public function setTiimi_id($id) {
        $this->Tiimi_id = $id;
    }

    public static function etsiTiiminjasenet($tiimi) {
        require_once "libs/tietokantayhteys.php";
        $sql = "select * from Tiiminjasen where tiimi_id = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tiimi));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tulokset[] = $tulos->poke_id;
        }
        return $tulokset;
    }
    
    function onkoOlemassa() {
        require_once "libs/tietokantayhteys.php";
        $sql = "select * from Tiiminjasen where poke_id = ? and tiimi_id = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->Poke_id, $this->Tiimi_id));
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return false;
        }
        $this->virheet['olemassa'] = 'Pokemon on jo tiimissä';
        return true;
    }
    
    function onkoTaynna() {
        require_once "libs/tietokantayhteys.php";
        $sql = "select count(*) from Tiiminjasen where tiimi_id = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->Tiimi_id));
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return false;
        }
        if ($tulos->count < 6) {
            return false;
        }
        $this->virheet['taynna'] = 'Tiimi on täynnä';
        return true;
    }
    
    public function lisaaKantaan() {
        require_once "libs/tietokantayhteys.php";
        $sql = "Insert into Tiiminjasen Values (?,?)";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->Poke_id, $this->Tiimi_id));
    }

    public static function poistaKannasta($tiimi, $poke) {
        require_once "libs/tietokantayhteys.php";
        $sql = "DELETE FROM Tiiminjasen WHERE tiimi_id = ? AND poke_id = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tiimi, $poke));
    }

    public function onkoKelvollinen() {
        return empty($this->virheet);
    }

    public function getVirheet() {
        return $this->virheet;
    }

}

?>