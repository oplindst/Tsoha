<?php

session_start();

function kaytaTietokantaa($sql) {
    require_once "libs/tietokantayhteys.php";
    $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
    $kysely->execute();
    return $kysely;
}

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    require 'views/pohja.php';
    exit();
}

function kirjautunut() {
    if (isset($_SESSION["kirjautunut"])) {
        return true;
    }
    header('Location: index.php');
    return false;
}

function admin() {
    if (isset($_SESSION["kirjautunut"])) {
        if ($_SESSION["kirjautunut"] == 1) {
            return true;
        }
    }
    header('Location: index.php');
    return false;
}

function kokoaParametrit($tulos) {
    $param = array();
    $ID = $tulos->pokeid;
    $param[] = $ID;
    $Nimi = $tulos->nimi;
    $param[] = $Nimi;
    $Type1 = $tulos->type1;
    $param[] = $Type1;
    $Type2 = $tulos->type2;
    $param[] = $Type2;
    $BHP = $tulos->bhp;
    $param[] = $BHP;
    $BAtk = $tulos->batk;
    $param[] = $BAtk;
    $BDef = $tulos->bdef;
    $param[] = $BDef;
    $BSpAtk = $tulos->bspatk;
    $param[] = $BSpAtk;
    $BSpDef = $tulos->bspdef;
    $param[] = $BSpDef;
    $BSpd = $tulos->bspd;
    $param[] = $BSpd;
    return $param;
}

function kokoaPokemonParametrit($tulos) {
    $param = array();
    $ID = $tulos->id;
    $param[] = $ID;
    $Laji = $tulos->laji;
    $param[] = $Laji;
    $Nimi = $tulos->nimi;
    $param[] = $Nimi;
    $Taso = $tulos->taso;
    $param[] = $Taso;
    $HP = $tulos->hp;
    $param[] = $HP;
    $Atk = $tulos->atk;
    $param[] = $Atk;
    $Def = $tulos->def;
    $param[] = $Def;
    $SpAtk = $tulos->spatk;
    $param[] = $SpAtk;
    $SpDef = $tulos->spdef;
    $param[] = $SpDef;
    $Spd = $tulos->spd;
    $param[] = $Spd;
    return $param;
}

function uusiLaji($tulos) {
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
    return $laji;
}

function uusiPokemon($tulos) {
    $pokemon = new Pokemon();
    $pokemon->setId($tulos->pokeid);
    $pokemon->setLaji($tulos->laji);
    $pokemon->setName($tulos->nimi);
    $pokemon->setTaso($tulos->taso);
    $pokemon->setHP($tulos->hp);
    $pokemon->setAtk($tulos->atk);
    $pokemon->setDef($tulos->def);
    $pokemon->setSpAtk($tulos->spatk);
    $pokemon->setSpDef($tulos->spdef);
    $pokemon->setSpd($tulos->spd);
    $pokemon->setIVs(array($tulos->hpiv, $tulos->atkiv, $tulos->defiv, $tulos->spatkiv, $tulos->spdefiv, $tulos->spdiv));
    $pokemon->setEVs(array($tulos->hpev, $tulos->atkev, $tulos->defev, $tulos->spatkev, $tulos->spdefev, $tulos->spdev));
    $pokemon->setNature($tulos->nature);
    $pokemon->setKommentti($tulos->kommentti);
    return $pokemon;
}
