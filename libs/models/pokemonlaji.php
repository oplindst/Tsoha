<?php

require_once 'libs/functions.php';
require_once 'libs/models/haettava.php';

class Pokemonlaji extends Haettava {

    private $ID;
    private $Nimi;
    private $Type1;
    private $Type2;
    public $HP;
    public $Atk;
    public $Def;
    public $SpAtk;
    public $SpDef;
    public $Spd;
    public $virheet = array();

    public function __construct($param) {
        $this->ID = $param[0];
        $this->Nimi = $param[1];
        $this->Type1 = $param[2];
        $this->Type2 = $param[3];
        $this->HP = $param[4];
        $this->Atk = $param[5];
        $this->Def = $param[6];
        $this->SpAtk = $param[7];
        $this->SpDef = $param[8];
        $this->Spd = $param[9];
    }

    public function getId() {
        return $this->ID;
    }

    public function setId($id) {
        $this->ID = $id;

        if (!preg_match('/^\d+$/', $id)) {
            $this->virheet['id'] = "ID:n pitää olla positiivinen numero.";
        } else if ($id > 2000) {
            $this->virheet['id'] = "ID:n pitää olla 2000 tai pienempi";
        } else {
            unset($this->virheet['id']);
        }
    }

    public static function etsiPokemon($id) {
        require_once "libs/tietokantayhteys.php";
        $sql = "select * from Pokemonlaji where id = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            echo 'joo';
            return null;
        }
        return $tulos;
    }

    public static function etsiPokemoneja($nimi, $type1, $type2, $hp, $atk, $def, $spatk, $spdef, $spd) {
        require_once "libs/tietokantayhteys.php";
        $sql = "Select * from Pokemonlaji where ";
        $parametrit = array();
        if ($nimi !== "") {
            $sql .= "Nimi ILIKE ? AND ";
            $parametrit[] = '%' . $nimi . '%';
        }
        if ($type1 !== '-' && $type2 !== '-') {
            $sql .= "((Type1 = ? AND Type2 = ?) OR (Type2 = ? AND Type1 = ?)) and ";
            $parametrit[] = $type1;
            $parametrit[] = $type2;
            $parametrit[] = $type1;
            $parametrit[] = $type2;
        } else if ($type1 !== '-' && $type2 === '-') {
            $sql .= "(Type1 = ? OR Type2 = ?) and ";
            $parametrit[] = $type1;
            $parametrit[] = $type1;
        } else if ($type1 === '-' && $type2 !== '-') {
            $sql .= "(Type1 = ? OR Type2 = ?) and ";
            $parametrit[] = $type2;
            $parametrit[] = $type2;
        }
        if ($hp !== "") {
            $sql .= "BHP >= ? and ";
            $parametrit[] = $hp;
        }
        if ($atk !== "") {
            $sql .= "BAtk >= ? and ";
            $parametrit[] = $atk;
        }
        if ($def !== "") {
            $sql .= "BDef >= ? and ";
            $parametrit[] = $def;
        }
        if ($spatk !== "") {
            $sql .= "BSpAtk >= ? and ";
            $parametrit[] = $spatk;
        }
        if ($spdef !== "") {
            $sql .= "BSpDef >= ? and ";
            $parametrit[] = $spdef;
        }
        if ($spd !== "") {
            $sql .= "BSpd >= ? and ";
            $parametrit[] = $spd;
        }
        $sql .= "id >= 0 order by id";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute($parametrit);

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tulokset[] = uusiLaji($tulos);
        }
        return $tulokset;
    }

    public static function etsiKaikkiPokemonit($order) {

        $sql = "select * from Pokemonlaji Order By " . $order . ", id";
        $kysely = kaytaTietokantaa($sql);

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tulokset[] = uusiLaji($tulos);
        }
        return $tulokset;
    }

    public function lisaaKantaan() {
        require_once "libs/tietokantayhteys.php";
        $sql = "Insert into Pokemonlaji Values (?,?,?,?,?,?,?,?,?,?)";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->ID, $this->Nimi, $this->Type1, $this->Type2, $this->HP, $this->Atk, $this->Def, $this->SpAtk, $this->SpDef, $this->Spd));
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
        $kysely->execute(array($this->ID, $this->Nimi, $this->Type1, $this->Type2, $this->HP, $this->Atk, $this->Def, $this->SpAtk, $this->SpDef, $this->Spd, $vanhaid));
    }

    public function getName() {
        return $this->Nimi;
    }

    public function setName($nimi) {
        $this->Nimi = $nimi;

        if (trim($nimi) === '') {
            $this->virheet['nimi'] = "Nimi ei saa olla tyhjä";
        } else if (htmlspecialchars($nimi) !== $nimi) {
            $this->virheet['nimi'] = "Erikoismerkit kielletty";
        } else if (strlen($nimi) > 15) {
            $this->virheet['nimi'] = "Nimen pitää olla 15 merkkiä tai alle.";
        } else {
            unset($this->virheet['nimi']);
        }
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
        return $this->HP;
    }

    public function setHP($hp) {
        $this->HP = $hp;

        if (!preg_match('/^\d+$/', $hp)) {
            $this->virheet['hp'] = "Base HP:n pitää olla positiivinen numero.";
        } else if ($hp > 255) {
            $this->virheet['hp'] = "Base HP:n pitää olla 255 tai pienempi";
        } else {
            unset($this->virheet['hp']);
        }
    }

    public function getAtk() {
        return $this->Atk;
    }

    public function setAtk($atk) {
        $this->Atk = $atk;

        if (!preg_match('/^\d+$/', $atk)) {
            $this->virheet['atk'] = "Base Attackin pitää olla positiivinen numero.";
        } else if ($atk > 255) {
            $this->virheet['atk'] = "Base Attackin pitää olla 255 tai pienempi";
        } else {
            unset($this->virheet['atk']);
        }
    }

    public function getDef() {
        return $this->Def;
    }

    public function setDef($def) {
        $this->Def = $def;

        if (!preg_match('/^\d+$/', $def)) {
            $this->virheet['def'] = "Base Defensen pitää olla positiivinen numero.";
        } else if ($def > 255) {
            $this->virheet['def'] = "Base Defensen pitää olla 255 tai pienempi";
        } else {
            unset($this->virheet['def']);
        }
    }

    public function getSpAtk() {
        return $this->SpAtk;
    }

    public function setSpAtk($spatk) {
        $this->SpAtk = $spatk;

        if (!preg_match('/^\d+$/', $spatk)) {
            $this->virheet['spatk'] = "Base Sp. Attackin pitää olla positiivinen numero.";
        } else if ($spatk > 255) {
            $this->virheet['spatk'] = "Base Sp. Attackin pitää olla 255 tai pienempi";
        } else {
            unset($this->virheet['spatk']);
        }
    }

    public function getSpDef() {
        return $this->SpDef;
    }

    public function setSpDef($spdef) {
        $this->SpDef = $spdef;

        if (!preg_match('/^\d+$/', $spdef)) {
            $this->virheet['spdef'] = "Base Sp. Defensen pitää olla positiivinen numero.";
        } else if ($spdef > 255) {
            $this->virheet['spdef'] = "Base Sp. Defensen pitää olla 255 tai pienempi";
        } else {
            unset($this->virheet['spdef']);
        }
    }

    public function getSpd() {
        return $this->Spd;
    }

    public function setSpd($spd) {
        $this->Spd = $spd;

        if (!preg_match('/^\d+$/', $spd)) {
            $this->virheet['spd'] = "Base Speedin pitää olla positiivinen numero.";
        } else if ($spd > 255) {
            $this->virheet['spd'] = "Base Speedin pitää olla 255 tai pienempi";
        } else {
            unset($this->virheet['spd']);
        }
    }

    public function onkoKelvollinen() {
        return empty($this->virheet);
    }

    public function getVirheet() {
        return $this->virheet;
    }

}
?>

