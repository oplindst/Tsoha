<?php

class Haettava {
    
    public $HP;
    public $Atk;
    public $Def;
    public $SpAtk;
    public $SpDef;
    public $Spd;
    public $virheet = array();
    
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
