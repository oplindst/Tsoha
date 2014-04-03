<?php

require_once 'libs/functions.php';

class Pokemonlaji {

    private $ID;
    private $Nimi;
    private $Type1;
    private $Type2;
    private $BHP;
    private $BAtk;
    private $BDef;
    private $BSpAtk;
    private $BSpDef;
    private $BSpd;

    public function __construct($id, $nimi, $type1, $type2, $hp, $atk, $def, $spatk, $spdef, $spd) {
        $this->ID = $id;
        $this->Nimi = $nimi;
        $this->Type1 = $type1;
        $this->Type2 = $type2;
        $this->BHP = $hp;
        $this->BAtk = $atk;
        $this->BDef = $def;
        $this->BSpAtk = $spatk;
        $this->BSpDef = $spdef;
        $this->BSpd = $spd;
    }

    public function getId() {
        return $this->ID;
    }
    
    public function setId($id) {
        $this->ID = $id;
    }

    public static function etsiKaikkiPokemonit() {
        $sql = "select * from Pokemonlaji";
        $kysely = haeTietokannasta($sql);

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $laji = new Pokemonlaji();
            $laji->setId($tulos->id);
            $laji->setName($tulos->nimi);
            $laji->setType1($tulos->type1);
            $laji->setType2($tulos->type2);
            $laji->setHP($tulos->bhp);
            $laji->setAtk($tulos->batk);
            $laji->setDef($tulos->bdef);
            $laji->setSpAtk($tulos->bspatk);
            $laji->setSpDef($tulos->bspdef);
            $laji->setSpd($tulos->bspd);
            
            $tulokset[] = $laji;
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
    
    public function getName() {
        return $this->Nimi;
    }
    
    public function setName($nimi) {
        $this->Nimi = $nimi;
    }
    
    public function getType1() {
        return $this->Type1;
    }
    
    public function setType1($type) {
        $this->Type1 = $type;
    }
    
    public function getType2() {
        return $this->Type2;
    }
    
    public function setType2($type) {
        $this->Type2 = $type;
    }
    
    public function getHP() {
        return $this->BHP;
    }
    
    public function setHP($hp) {
        $this->BHP = $hp;
    }
    
    public function getAtk() {
        return $this->BAtk;
    }
    
    public function setAtk($atk) {
        $this->BAtk = $atk;
    }
    
    public function getDef() {
        return $this->BDef;
    }
    
    public function setDef($def) {
        $this->BDef = $def;
    }
    
    public function getSpAtk() {
        return $this->BSpAtk;
    }
    
    public function setSpAtk($spatk) {
        $this->BSpAtk = $spatk;
    }
    
    public function getSpDef() {
        return $this->BSpDef;
    }
    
    public function setSpDef($spdef) {
        $this->BSpDef = $spdef;
    }
    
    public function getSpd() {
        return $this->BSpd;
    }
    
    public function setSpd($spd) {
        $this->BSpd = $spd;
    }

}

?>

