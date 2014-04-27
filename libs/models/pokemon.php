<?php

require_once 'libs/functions.php';
require_once 'libs/models/haettava.php';

class Pokemon extends Haettava {

    private $ID;
    private $Laji;
    private $Nimi;
    private $Taso;
    public $HP;
    public $Atk;
    public $Def;
    public $SpAtk;
    public $SpDef;
    public $Spd;
    private $IVs;
    private $EVs;
    private $nature;
    private $omistaja;
    private $kommentti;
    public $virheet = array();

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
        $sql = "select * from Pokemon where pokeid = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
        $tulokset = array();

        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tulokset[] = uusiPokemon($tulos);
        }
        return $tulokset[0];
    }

    public static function etsiPokemoneja($nimi, $type1, $type2, $hp, $atk, $def, $spatk, $spdef, $spd, $id) {
        require_once "libs/tietokantayhteys.php";
        $sql = "Select * from Pokemon, Pokemonlaji where ";
        $parametrit = array();
        if ($nimi !== "") {
            $sql .= "Pokemon.Nimi ILIKE ? AND";
            $parametrit[] = '%' . $nimi . '%';
        }
        if ($type1 !== '-' && $type2 !== '-') {
            $sql .= "((Type1 = ? AND Type2 = ?) OR (Type2 = ? AND Type1 = ?)) AND ";
            $parametrit[] = $type1;
            $parametrit[] = $type2;
            $parametrit[] = $type1;
            $parametrit[] = $type2;
        } else if ($type1 !== '-' && $type2 === '-') {
            $sql .= "(Type1 = ? OR Type2 = ?) AND ";
            $parametrit[] = $type1;
            $parametrit[] = $type1;
        } else if ($type1 === '-' && $type2 !== '-') {
            $sql .= "(Type1 = ? OR Type2 = ?) AND ";
            $parametrit[] = $type2;
            $parametrit[] = $type2;
        }
        if ($hp !== "") {
            $sql .= "HP >= ? AND ";
            $parametrit[] = $hp;
        }
        if ($atk !== "") {
            $sql .= "Atk >= ? AND ";
            $parametrit[] = $atk;
        }
        if ($def !== "") {
            $sql .= "Def >= ? AND ";
            $parametrit[] = $def;
        }
        if ($spatk !== "") {
            $sql .= "SpAtk >= ? AND ";
            $parametrit[] = $spatk;
        }
        if ($spdef !== "") {
            $sql .= "SpDef >= ? AND ";
            $parametrit[] = $spdef;
        }
        if ($spd !== "") {
            $sql .= "Spd >= ? AND ";
            $parametrit[] = $spd;
        }
        $sql .= "Omistaja = ? AND Pokemon.laji = Pokemonlaji.id Order by Pokemonlaji.id";
        $parametrit[] = $id;
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute($parametrit);

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tulokset[] = uusiPokemon($tulos);
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
        $sql = "select * from Pokemon where Omistaja = ? order by " . $order . ", laji";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($omistaja));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tulokset[] = uusiPokemon($tulos);
        }
        return $tulokset;
    }

    public function lisaaKantaan($omistaja) {
        require_once "libs/tietokantayhteys.php";
        $sql = "Insert into Pokemon (laji, nimi, taso, hp, atk, def, spatk, spdef, spd, hpiv, atkiv, defiv, spatkiv, spdefiv, spdiv, hpev, atkev, defev, spatkev, spdefev, spdev, nature, kommentti, omistaja) Values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $param = $this->kokoaPaivitysparametrit();
        $param[] = $omistaja;
        $kysely->execute($param);
    }

    public static function poistaKannasta($id) {
        require_once "libs/tietokantayhteys.php";
        $sql = "DELETE FROM Pokemon WHERE pokeid = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
    }

    public function paivita($id) {
        require_once "libs/tietokantayhteys.php";
        $sql = "UPDATE Pokemon SET laji = ?, Nimi = ?, Taso = ?, HP = ?, Atk = ?, Def = ?, SpAtk = ?, SpDef = ?, Spd = ?, hpiv = ?, atkiv = ?, defiv = ?, spatkiv = ?, spdefiv = ?, spdiv = ?, hpev = ?, atkev = ?, defev = ?, spatkev = ?, spdefev = ?, spdev = ?, nature = ?, kommentti = ? WHERE pokeid = ?";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $param = $this->kokoaPaivitysparametrit();
        $param[] = $id;
        $kysely->execute($param);
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

    public function getKommentti() {
        return $this->kommentti;
    }

    public function setKommentti($kommentti) {
        $this->kommentti = $kommentti;

        if (htmlspecialchars($kommentti) !== $kommentti) {
            $this->virheet['kommentti'] = "Erikoismerkit kielletty";
        } else if (strlen($kommentti) > 50) {
            $this->virheet['kommentti'] = "Kommentin pitää olla 50 merkkiä tai alle.";
        } else {
            unset($this->virheet['kommentti']);
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
        } else if (Pokemonlaji::etsiPokemon($laji) == null) {
            $this->virheet['laji'] = "Lajia ei ole olemassa vielä";
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

    public function getIVs() {
        return $this->IVs;
    }

    public function setIVs($ivs = array()) {
        $this->IVs = $ivs;
    }

    public function getEVs() {
        return $this->EVs;
    }

    public function setEVs($evs = array()) {
        $this->EVs = $evs;
    }

    public function getNature() {
        return $this->nature;
    }

    public function setNature($nature) {
        $this->nature = $nature;
    }

    public function onkoKelvollinen() {
        return empty($this->virheet);
    }

    public function getVirheet() {
        return $this->virheet;
    }

    private function kokoaPaivitysparametrit() {
        $param = array($this->Laji, $this->Nimi, $this->Taso, $this->HP, $this->Atk, $this->Def, $this->SpAtk, $this->SpDef, $this->Spd);
        $merge1 = array_merge($param, $this->IVs);
        $merge2 = array_merge($merge1, $this->EVs);
        $merge2[] = $this->nature;
        $merge2[] = $this->kommentti;
        return $merge2;
    }
}
?>

