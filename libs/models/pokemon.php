<?php

require_once 'libs/functions.php';

class Pokemon {

    private $Laji;
    private $Nimi;
    private $Taso;
    private $HP;
    private $Atk;
    private $Def;
    private $SpAtk;
    private $SpDef;
    private $Spd;
    private $omistaja;
    private $virheet = array();

    public function __construct($param) {
        $this->Laji = $param[0];
        $this->Nimi = $param[1];
        $this->Taso = $param[2];
        $this->HP = $param[3];
        $this->Atk = $param[4];
        $this->Def = $param[5];
        $this->SpAtk = $param[6];
        $this->SpDef = $param[7];
        $this->Spd = $param[8];
        $this->omistaja = $param[9];
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

    public static function etsiPokemoneja($nimi, $type1, $type2, $hp, $atk, $def, $spatk, $spdef, $spd) {
        require_once "libs/tietokantayhteys.php";
        $sql = "";
        $parametrit = array();
        if ($nimi !== "") {
            $sql .= "Select * from Pokemonlaji where Nimi = ? INTERSECT ";
            $parametrit[] = $nimi;
        }
        if ($type1 !== '-' && $type2 !== '-') {
            $sql .= "Select * from Pokemonlaji where (Type1 = ? AND Type2 = ?) OR (Type2 = ? AND Type1 = ?) INTERSECT ";
            $parametrit[] = $type1;
            $parametrit[] = $type2;
            $parametrit[] = $type1;
            $parametrit[] = $type2;
        } else if ($type1 !== '-' && $type2 === '-') {
            $sql .= "Select * from Pokemonlaji where Type1 = ? OR Type2 = ? INTERSECT ";
            $parametrit[] = $type1;
            $parametrit[] = $type1;
        } else if ($type1 === '-' && $type2 !== '-') {
            $sql .= "Select * from Pokemonlaji where Type1 = ? OR Type2 = ? INTERSECT ";
            $parametrit[] = $type2;
            $parametrit[] = $type2;
        }
        if ($hp !== "") {
            $sql .= "Select * from Pokemonlaji where BHP >= ? INTERSECT ";
            $parametrit[] = $hp;
        }
        if ($atk !== "") {
            $sql .= "Select * from Pokemonlaji where BAtk >= ? INTERSECT ";
            $parametrit[] = $atk;
        }
        if ($def !== "") {
            $sql .= "Select * from Pokemonlaji where BDef >= ? INTERSECT ";
            $parametrit[] = $def;
        }
        if ($spatk !== "") {
            $sql .= "Select * from Pokemonlaji where BSpAtk >= ? INTERSECT ";
            $parametrit[] = $spatk;
        }
        if ($spdef !== "") {
            $sql .= "Select * from Pokemonlaji where BSpDef >= ? INTERSECT ";
            $parametrit[] = $spdef;
        }
        if ($spd !== "") {
            $sql .= "Select * from Pokemonlaji where BSpd >= ? INTERSECT ";
            $parametrit[] = $spd;
        }
        $sql .= "Select * from Pokemonlaji";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute($parametrit);

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

    public static function etsiKaikkiPokemonit($omistaja) {
        require_once "libs/tietokantayhteys.php";
        $sql = "select * from Pokemon where Omistaja = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($omistaja));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $param = kokoaPokemonParametrit($tulos);
            $pokemon = new Pokemon($param);
            $tulokset[] = $pokemon;
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

    public function getLaji() {
        return $this->Laji;
    }

    public function setLaji($laji) {
        $this->Laji = $laji;
    }

    public function getTaso() {
        return $this->Taso;
    }

    public function setTaso($taso) {
        $this->Taso = $taso;
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

    public function poistaVirheitaHakuaVarten() {
        if ($this->BHP === '') {
            unset($this->virheet['hp']);
        }
        if ($this->BAtk === '') {
            unset($this->virheet['atk']);
        }
        if ($this->BDef === '') {
            unset($this->virheet['def']);
        }
        if ($this->BSpAtk === '') {
            unset($this->virheet['spatk']);
        }
        if ($this->BSpDef === '') {
            unset($this->virheet['spdef']);
        }
        if ($this->BSpd === '') {
            unset($this->virheet['spd']);
        }
        if (preg_match('/^\d+$/', $this->BHP)) {
            if ($this->BHP > 255) {
                unset($this->virheet['hp']);
            }
        }
        if (preg_match('/^\d+$/', $this->BAtk)) {
            if ($this->BAtk > 255) {
                unset($this->virheet['atk']);
            }
        }
        if (preg_match('/^\d+$/', $this->BDef)) {
            if ($this->BDef > 255) {
                unset($this->virheet['def']);
            }
        }
        if (preg_match('/^\d+$/', $this->BSpAtk)) {
            if ($this->BSpAtk > 255) {
                unset($this->virheet['spatk']);
            }
        }
        if (preg_match('/^\d+$/', $this->BSpDef)) {
            if ($this->BSpDef > 255) {
                unset($this->virheet['spdef']);
            }
        }
        if (preg_match('/^\d+$/', $this->BSpd)) {
            if ($this->BSpd > 255) {
                unset($this->virheet['spd']);
            }
        }
    }

}
?>

