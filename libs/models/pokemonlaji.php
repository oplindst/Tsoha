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
    private $virheet = array();

    public function __construct($param) {
        $this->ID = $param[0];
        $this->Nimi = $param[1];
        $this->Type1 = $param[2];
        $this->Type2 = $param[3];
        $this->BHP = $param[4];
        $this->BAtk = $param[5];
        $this->BDef = $param[6];
        $this->BSpAtk = $param[7];
        $this->BSpDef = $param[8];
        $this->BSpd = $param[9];
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

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        }

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
            $sql .= "Select * from Pokemonlaji where Nimi ILIKE ? INTERSECT ";
            $parametrit[] = '%' . $nimi . '%';
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
        $sql .= "Select * from Pokemonlaji order by id";
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

    public static function etsiKaikkiPokemonit($order) {

        $sql = "select * from Pokemonlaji Order By ".$order. ", id";
        $kysely = kaytaTietokantaa($sql);

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $param = kokoaParametrit($tulos);
            $laji = new Pokemonlaji($param);
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
        return $this->BHP;
    }

    public function setHP($hp) {
        $this->BHP = $hp;

        if (!preg_match('/^\d+$/', $hp)) {
            $this->virheet['hp'] = "Base HP:n pitää olla positiivinen numero.";
        } else if ($hp > 255) {
            $this->virheet['hp'] = "Base HP:n pitää olla 255 tai pienempi";
        }
        else {
            unset($this->virheet['hp']);
        }
    }

    public function getAtk() {
        return $this->BAtk;
    }

    public function setAtk($atk) {
        $this->BAtk = $atk;
        
        if (!preg_match('/^\d+$/', $atk)) {
            $this->virheet['atk'] = "Base Attackin pitää olla positiivinen numero.";
        } else if ($atk > 255) {
            $this->virheet['atk'] = "Base Attackin pitää olla 255 tai pienempi";
        } else {
            unset($this->virheet['atk']);
        }
    }

    public function getDef() {
        return $this->BDef;
    }

    public function setDef($def) {
        $this->BDef = $def;
        
        if (!preg_match('/^\d+$/', $def)) {
            $this->virheet['def'] = "Base Defensen pitää olla positiivinen numero.";
        } else if ($def > 255) {
            $this->virheet['def'] = "Base Defensen pitää olla 255 tai pienempi";
        } else {
            unset($this->virheet['def']);
        }
    }

    public function getSpAtk() {
        return $this->BSpAtk;
    }

    public function setSpAtk($spatk) {
        $this->BSpAtk = $spatk;
        
        if (!preg_match('/^\d+$/', $spatk)) {
            $this->virheet['spatk'] = "Base Sp. Attackin pitää olla positiivinen numero.";
        } else if ($spatk > 255) {
            $this->virheet['spatk'] = "Base Sp. Attackin pitää olla 255 tai pienempi";
        } else {
            unset($this->virheet['spatk']);
        }
    }

    public function getSpDef() {
        return $this->BSpDef;
    }

    public function setSpDef($spdef) {
        $this->BSpDef = $spdef;
        
        if (!preg_match('/^\d+$/', $spdef)) {
            $this->virheet['spdef'] = "Base Sp. Defensen pitää olla positiivinen numero.";
        } else if ($spdef > 255) {
            $this->virheet['spdef'] = "Base Sp. Defensen pitää olla 255 tai pienempi";
        } else {
            unset($this->virheet['spdef']);
        }
    }

    public function getSpd() {
        return $this->BSpd;
    }

    public function setSpd($spd) {
        $this->BSpd = $spd;
        
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

