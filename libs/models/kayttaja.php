<?php

class Kayttaja {

    private $Id;
    private $Tunnus;
    private $Salasana;
    private $Sala2;
    private $virheet = array();

    public function __construct($id, $tunnus, $salasana) {
        $this->Id = $id;
        $this->Tunnus = $tunnus;
        $this->Salasana = $salasana;
    }

    public function getId() {
        return $this->Id;
    }

    public function getTunnus() {
        return $this->Tunnus;
    }

    public function getSalasana() {
        return $this->Salasana;
    }

    public function setId($id) {
        $this->Id = $id;
    }

    public function setTunnus($tunnus) {
        $this->Tunnus = $tunnus;

        if (trim($tunnus) === '') {
            $this->virheet['tunnus'] = "Käyttäjätunnus ei saa olla tyhjä";
        } else if (htmlspecialchars($tunnus) !== $tunnus) {
            $this->virheet['tunnus'] = "Erikoismerkit kielletty";
        } else if (strlen($tunnus) > 15) {
            $this->virheet['tunnus'] = "Tunnuksen pitää olla 15 merkkiä tai alle.";
        } else {
            unset($this->virheet['tunnus']);
        }
    }

    public function setSalasana($salasana) {
        $this->Salasana = $salasana;

        if (trim($salasana) === '') {
            $this->virheet['salasana'] = "Salasana ei saa olla tyhjä";
        } else if (htmlspecialchars($salasana) !== $salasana) {
            $this->virheet['salasana'] = "Erikoismerkit kielletty";
        } else if (strlen($salasana) > 15) {
            $this->virheet['salasana'] = "Salasanan pitää olla 15 merkkiä tai alle.";
        } else {
            unset($this->virheet['salasana']);
        }
    }

    public function setSala2($salasana) {
        $this->Sala2 = $salasana;

        if (trim($salasana) === '') {
            $this->virheet['sala2'] = "Salasana ei saa olla tyhjä";
        } else if (htmlspecialchars($salasana) !== $salasana) {
            $this->virheet['sala2'] = "Erikoismerkit kielletty";
        } else if (strlen($salasana) > 15) {
            $this->virheet['sala2'] = "Salasanan pitää olla 15 merkkiä tai alle.";
        } else if (!($salasana === $this->Salasana)) {
            $this->virheet['sala2'] = "Salasanat eivät täsmää.";
        } else {
            unset($this->virheet['salasana']);
        }
    }

    public static function etsiKaikkiKayttajat() {
        $sql = "select id, tunnus, salasana from kayttaja";
        $kysely = kaytaTietokantaa($sql);

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kayttaja = new Kayttaja();
            $kayttaja->setId($tulos->id);
            $kayttaja->setTunnus($tulos->tunnus);
            $kayttaja->setSalasana($tulos->salasana);

            $tulokset[] = $kayttaja;
        }
        return $tulokset;
    }

    public static function etsiKayttajaTunnuksilla($kayttaja) {
        require_once "libs/tietokantayhteys.php";
        $sql = "SELECT * from kayttaja where tunnus = ? LIMIT 1";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kayttaja));

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

    public function lisaaKantaan() {
        require_once "libs/tietokantayhteys.php";
        $sql = "Insert into Kayttaja(Tunnus, Salasana) Values (?,?)";
        $kysely = Yhteys::getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->Tunnus, $this->Salasana));
    }

    public function onkoKelvollinen() {
        return empty($this->virheet);
    }

    public function getVirheet() {
        return $this->virheet;
    }

}

?>
