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
            $laji = new Pokemonlaji($tulos->ID, $tulos->Nimi, $tulos->Type1,$tulos->Type2,$tulos->BHP,$tulos->BAtk,$tulos->BDef,$tulos->BSpAtk,$tulos->BSpDef,$tulos->BSpd);
            
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

}

?>

