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
    
    public static function etsiPokemon($id) {
        require_once "libs/tietokantayhteys.php";
        $sql = "select * from Pokemonlaji where id = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
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
        return $tulokset[0];
    }
    
    public static function etsiPokemoneja($id, $nimi, $type1, $type2, $hp, $atk, $def, $spatk, $spdef, $spd) {
        require_once "libs/tietokantayhteys.php";
        $sql = "Select * from Pokemonlaji where ID = ?, Nimi = ?, Type1 = ?, Type2 = ?, BHP = ?, BAtk = ?, BDef = ?, BSpAtk = ?, BSpDef = ?, BSpd = ? WHERE ID = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->ID, $this->Nimi, $this->Type1, $this->Type2, $this->BHP, $this->BAtk, $this->BDef, $this->BSpAtk, $this->BSpDef, $this->BSpd));
        
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

    public static function etsiKaikkiPokemonit() {

        $sql = "select * from Pokemonlaji Order By id";
        $kysely = kaytaTietokantaa($sql);

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

    public function lisaaKantaan() {
        require_once "libs/tietokantayhteys.php";
        $sql = "Insert into Pokemonlaji Values (?,?,?,?,?,?,?,?,?,?)";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->ID, $this->Nimi, $this->Type1, $this->Type2, $this->BHP, $this->BAtk, $this->BDef, $this->BSpAtk, $this->BSpDef, $this->BSpd));
    }
    
    public static function poistaKannasta($id) {
        require_once "libs/tietokantayhteys.php";
        $sql = "DELETE FROM Pokemonlaji WHERE id = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
    }
    
    public function paivita($vanhaid) {
        require_once "libs/tietokantayhteys.php";
        $sql = "UPDATE Pokemonlaji SET ID = ?, Nimi = ?, Type1 = ?, Type2 = ?, BHP = ?, BAtk = ?, BDef = ?, BSpAtk = ?, BSpDef = ?, BSpd = ? WHERE ID = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->ID, $this->Nimi, $this->Type1, $this->Type2, $this->BHP, $this->BAtk, $this->BDef, $this->BSpAtk, $this->BSpDef, $this->BSpd, $vanhaid));
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

