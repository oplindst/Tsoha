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
        $kayttaja = $_SESSION["kirjautunut"];
        return true;
    }
    header('Location: login.php');
    return false;
}

function kokoaParametrit($tulos) {
        $param = array();
        $ID = $tulos->id;
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
        $BSpDef = $tulos->bspd;
        $param[] = $BSpDef;
        $BSpd = $tulos->bspd;
        $param[] = $BSpd;
        return $param;
    }
