<?php

require_once 'libs/functions.php';

class Pokemon {

    private $ID;
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
        $this->ID = $param[0];
        $this->Laji = $param[1];
        $this->Nimi = $param[2];
        $this->Taso = $param[3];
        $this->HP = $param[4];
        $this->Atk = $param[5];
        $this->Def = $param[6];
        $this->SpAtk = $param[7];
        $this->SpDef = $param[8];
        $this->Spd = $param[9];
        $this->omistaja = $param[10];
    }

    public function getId() {
        return $this->ID;
    }

    public function setId($id) {
        $this->ID = $id;

        if (!preg_match('/^\d+$/', $id)) {
            $this->virheet['id'] = "ID:n pitää olla positiivinen numero.";
        } else {
            unset($this->virheet['id']);
        }
    }

    public static function etsiPokemon($id) {
        require_once "libs/tietokantayhteys.php";
        $sql = "select * from Pokemon where id = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
        $tulokset = array();
        
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $pokemon = new Pokemon();
            $pokemon->setId($tulos->id);
            $pokemon->setLaji($tulos->laji);
            $pokemon->setName($tulos->nimi);
            $pokemon->setTaso($tulos->taso);
            $pokemon->setHP($tulos->hp);
            $pokemon->setAtk($tulos->atk);
            $pokemon->setDef($tulos->def);
            $pokemon->setSpAtk($tulos->spatk);
            $pokemon->setSpDef($tulos->spdef);
            $pokemon->setSpd($tulos->spd);
            $tulokset[] = $pokemon;
        }
        return $tulokset[0];
    }

    public static function etsiPokemoneja($nimi, $type1, $type2, $hp, $atk, $def, $spatk, $spdef, $spd, $id) {
        require_once "libs/tietokantayhteys.php";
        $sql = "";
        $parametrit = array();
        if ($nimi !== "") {
            $sql .= "Select * from Pokemon, Pokemonlaji where Pokemon.Nimi ILIKE ? INTERSECT ";
            $parametrit[] = '%' . $nimi . '%';
        }
        if ($type1 !== '-' && $type2 !== '-') {
            $sql .= "Select * from Pokemon, Pokemonlaji where (Type1 = ? AND Type2 = ?) OR (Type2 = ? AND Type1 = ?) INTERSECT ";
            $parametrit[] = $type1;
            $parametrit[] = $type2;
            $parametrit[] = $type1;
            $parametrit[] = $type2;
        } else if ($type1 !== '-' && $type2 === '-') {
            $sql .= "Select * from Pokemon, Pokemonlaji where Type1 = ? OR Type2 = ? INTERSECT ";
            $parametrit[] = $type1;
            $parametrit[] = $type1;
        } else if ($type1 === '-' && $type2 !== '-') {
            $sql .= "Select * from Pokemon, Pokemonlaji where Type1 = ? OR Type2 = ? INTERSECT ";
            $parametrit[] = $type2;
            $parametrit[] = $type2;
        }
        if ($hp !== "") {
            $sql .= "Select * from Pokemon, Pokemonlaji where HP >= ? INTERSECT ";
            $parametrit[] = $hp;
        }
        if ($atk !== "") {
            $sql .= "Select * from Pokemon, Pokemonlaji where Atk >= ? INTERSECT ";
            $parametrit[] = $atk;
        }
        if ($def !== "") {
            $sql .= "Select * from Pokemon, Pokemonlaji where Def >= ? INTERSECT ";
            $parametrit[] = $def;
        }
        if ($spatk !== "") {
            $sql .= "Select * from Pokemon, Pokemonlaji where SpAtk >= ? INTERSECT ";
            $parametrit[] = $spatk;
        }
        if ($spdef !== "") {
            $sql .= "Select * from Pokemon, Pokemonlaji where SpDef >= ? INTERSECT ";
            $parametrit[] = $spdef;
        }
        if ($spd !== "") {
            $sql .= "Select * from Pokemon, Pokemonlaji where Spd >= ? INTERSECT ";
            $parametrit[] = $spd;
        }
        $sql .= "Select * from Pokemon, Pokemonlaji where Omistaja = ? AND Pokemon.laji = Pokemonlaji.id Order by Pokemonlaji.id";
        $parametrit[] = $id;
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute($parametrit);

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $pokemon = new Pokemon();
            $pokemon->setLaji($tulos->laji);
            $pokemon->setName($tulos->nimi);
            $pokemon->setTaso($tulos->taso);
            $pokemon->setHP($tulos->hp);
            $pokemon->setAtk($tulos->atk);
            $pokemon->setDef($tulos->def);
            $pokemon->setSpAtk($tulos->spatk);
            $pokemon->setSpDef($tulos->spdef);
            $pokemon->setSpd($tulos->spd);
            $tulokset[] = $pokemon;
        }
        return $tulokset;
    }
    
    public static function haeTiiminPokemonit($id_lista) {
        $pokemonit = array();
        foreach ($id_lista as $id) {
            $pokemonit[] = Pokemon::etsiPokemon($id);
        }
        return $pokemonit;
    }

    public static function etsiKaikkiPokemonit($omistaja, $order) {
        require_once "libs/tietokantayhteys.php";
        $param = array();
        $sql = "select * from Pokemon where Omistaja = ? order by ".$order. ", laji";
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

    public function lisaaKantaan($omistaja) {
        require_once "libs/tietokantayhteys.php";
        $sql = "Insert into Pokemon (laji, nimi, taso, hp, atk, def, spatk, spdef, spd, omistaja) Values (?,?,?,?,?,?,?,?,?,?)";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->Laji, $this->Nimi, $this->Taso, $this->HP, $this->Atk, $this->Def, $this->SpAtk, $this->SpDef, $this->Spd, $omistaja));
    }

    public static function poistaKannasta($id) {
        require_once "libs/tietokantayhteys.php";
        $sql = "DELETE FROM Pokemon WHERE ID = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
    }

    public function paivita($id) {
        require_once "libs/tietokantayhteys.php";
        $sql = "UPDATE Pokemon SET laji = ?, Nimi = ?, Taso = ?, HP = ?, Atk = ?, Def = ?, SpAtk = ?, SpDef = ?, Spd = ? WHERE ID = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->Laji, $this->Nimi, $this->Taso, $this->HP, $this->Atk, $this->Def, $this->SpAtk, $this->SpDef, $this->Spd, $id));
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
        require_once "libs/models/pokemonlaji.php";
        
        if (!preg_match('/^\d+$/', $laji)) {
            $this->virheet['laji'] = "Lajinumeron pitää olla positiivinen numero.";
        } else if ($laji > 718) {
            $this->virheet['laji'] = "Lajinumeron pitää olla 718 tai pienempi";
        } else if (Pokemonlaji::etsiPokemon($laji)==null) {
            $this->virheet['olemassa'] = "Lajia ei ole olemassa";
        } else {
            unset($this->virheet['laji']);
        }
    }

    public function getTaso() {
        return $this->Taso;
    }

    public function setTaso($taso) {
        $this->Taso = $taso;
        
        if (!preg_match('/^\d+$/', $taso)) {
            $this->virheet['taso'] = "Taso pitää olla positiivinen numero.";
        } else if ($taso > 100) {
            $this->virheet['taso'] = "Tason pitää olla 100 tai pienempi";
        } else {
            unset($this->virheet['taso']);
        }
    }

    public function getHP() {
        return $this->HP;
    }

    public function setHP($hp) {
        $this->HP = $hp;

        if (!preg_match('/^\d+$/', $hp)) {
            $this->virheet['hp'] = "HP:n pitää olla positiivinen numero.";
        } else if ($hp > 1000) {
            $this->virheet['hp'] = "HP:n pitää olla 1000 tai pienempi";
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
            $this->virheet['atk'] = "Attackin pitää olla positiivinen numero.";
        } else if ($atk > 1000) {
            $this->virheet['atk'] = "Attackin pitää olla 1000 tai pienempi";
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
            $this->virheet['def'] = "Defensen pitää olla positiivinen numero.";
        } else if ($def > 1000) {
            $this->virheet['def'] = "Defensen pitää olla 1000 tai pienempi";
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
            $this->virheet['spatk'] = "Sp. Attackin pitää olla positiivinen numero.";
        } else if ($spatk > 1000) {
            $this->virheet['spatk'] = "Sp. Attackin pitää olla 1000 tai pienempi";
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
            $this->virheet['spdef'] = "Sp. Defensen pitää olla positiivinen numero.";
        } else if ($spdef > 1000) {
            $this->virheet['spdef'] = "Sp. Defensen pitää olla 1000 tai pienempi";
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
            $this->virheet['spd'] = "Speedin pitää olla positiivinen numero.";
        } else if ($spd > 1000) {
            $this->virheet['spd'] = "Speedin pitää olla 1000 tai pienempi";
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
        if ($this->HP === '') {
            unset($this->virheet['hp']);
        }
        if ($this->Atk === '') {
            unset($this->virheet['atk']);
        }
        if ($this->Def === '') {
            unset($this->virheet['def']);
        }
        if ($this->SpAtk === '') {
            unset($this->virheet['spatk']);
        }
        if ($this->SpDef === '') {
            unset($this->virheet['spdef']);
        }
        if ($this->Spd === '') {
            unset($this->virheet['spd']);
        }
        if (preg_match('/^\d+$/', $this->HP)) {
            if ($this->HP > 255) {
                unset($this->virheet['hp']);
            }
        }
        if (preg_match('/^\d+$/', $this->Atk)) {
            if ($this->Atk > 255) {
                unset($this->virheet['atk']);
            }
        }
        if (preg_match('/^\d+$/', $this->Def)) {
            if ($this->Def > 255) {
                unset($this->virheet['def']);
            }
        }
        if (preg_match('/^\d+$/', $this->SpAtk)) {
            if ($this->SpAtk > 255) {
                unset($this->virheet['spatk']);
            }
        }
        if (preg_match('/^\d+$/', $this->SpDef)) {
            if ($this->SpDef > 255) {
                unset($this->virheet['spdef']);
            }
        }
        if (preg_match('/^\d+$/', $this->Spd)) {
            if ($this->Spd > 255) {
                unset($this->virheet['spd']);
            }
        }
    }

}
?>

