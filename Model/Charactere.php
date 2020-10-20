<?php

namespace App\Model;

 abstract class Charactere
{

    private $_id;
    private $_name;
    private $_healthPoints = 100;
    private $_LVL = 1;
    private $_Exp = 0;
    private $_ExpRequire = 100;
    private $_strength = 0;
    private $_class;
    private $_damageRecieve;
    private $_malus = "";
    private $_statuts  = [
        'effect' => '',
        'turnStatuts' => 0,
    ];

    public function __construct($name = null , $class)
    {
        $this-> setName($name);
        $this -> setClass($class); 
    }

    public function hydrate(array $dataUsers)
    {
        foreach ($dataUsers as $key => $value) {
            $methode = "set" . ucfirst($key);
            if (method_exists($this, $methode)) {
                $this->$methode($value);
            }
        }
    }


    public function getId()
    {
        return $this->_id;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getHealthPoints()
    {
        return $this->_healthPoints;
    }

    public function getLVL()
    {
        return $this->_LVL;
    }

    public function getExp()
    {
        return $this->_Exp;
    }

    public function getExpRequire()
    {
        return $this->_ExpRequire;
    }

    public function getStrength()
    {
        return $this->_strength;
    }

    public function getCLass()
    {
        return $this->_class;
    }

    public function getDamageRecieve()
    {
        return $this->_damageRecieve;
    }
    public function getStatutEffect()
    {
        return $this->_statuts['effect'];
    }
    
    public function getStatutsLonger()
    {
        return  $this->_statuts['turnStatuts'];
    }


    public function setID($id)
    {
        $id = (int)$id;
        if ($id > 0) {
            $this->_id = $id;
            return;
        }
        trigger_error('Format id invalid', E_USER_WARNING);
    }

    public function setName($name = null)
    {
        if (is_string($name)) {
            $this->_name = $name;
            return;
        }
    }

    public function setHealthPoints($hp)
    {
        $hp = (int) $hp;
        if ($hp < 0) {
            $hp = 0;
        }
        $this->_healthPoints = $hp;
    }

    public function setLVL($lvl)
    {
        $lvl = (int)$lvl;
        if ($lvl > 0) {
            $this->_LVL = $lvl;
            return;
        }
        trigger_error('Format LVL invalid', E_USER_WARNING);
    }

    public function setExp($exp)
    {
        $exp = (int)$exp;
        if ($exp >= 0) {
            $this->_Exp = $exp;
            return;
        }
        trigger_error('Format exp invalid', E_USER_WARNING);
    }

    public function setExprequire($expRequire)
    {
        $expRequire = (int)$expRequire;
        if ($expRequire >= 0) {
            $this->_expRequire = $expRequire;
            return;
        }
        trigger_error('Format exp invalid', E_USER_WARNING);
    }

    public function setStrength($strength)
    {
        $strength = (int)$strength;
        if ($strength >= 0) {
            $this->_strength = $strength;
            return;
        }
        trigger_error('Format strength invalid', E_USER_WARNING);
    }

    private function setClass($class)
    {
        
        if (is_string($class)) {
            $this->_class = $class;
            return;
        }
        trigger_error('Format class invalid', E_USER_WARNING);
    }

    public function setStatuts($effect, $turnStatuts)
    {
        
        if (is_string($effect)) {
            $this->_statuts['effect'] = $effect;
            $this->_statuts['turnStatuts'] = $turnStatuts;
            return;
        }
        trigger_error('Format statuts invalid', E_USER_WARNING);
    }

    public function updateExp()
    {
        $this->_Exp = $this->_Exp + 20;
        if ($this->_Exp >= $this->_ExpRequire) {
            $this->_Exp = 0;
            $this -> LVLUP();
        }
    }

    public function LVLUP()
    {
        $this->updateLVL();
        $this->updateExpRequire();
        $this->updateStrength();
    }
    public function updateExpRequire()
    {
        $this->_ExpRequire = 100 + ($this->_LVL * 20);
    }

    public function updateHealth()
    {
        $this->_healthPoints = $this->_healthPoints + 50;
        if ($this->_healthPoints > 100) {
            $this->_healthPoints = 100;
        }
    }

    public function updateLVL()
    {
        $this->_LVL += 1;
    }

    public function updateStrength()
    {
        $this->_strength += 2;
    }

    public function hit($opposant)
    {
        $minDamage = 0 + ($this->_strength * 2);
        $maxDamage = 20 + ($this->_strength * 2);
        $damageDeal = rand($minDamage,  $maxDamage);
        $damage = $opposant -> damageRecieve($damageDeal);
        return $damage ;
    }

    public function updateStatuts($opposant) {
        $this -> _statuts['turnStatuts'] -= 1;
        if($this -> _statuts['turnStatuts'] == 0) {
            $this -> _statuts['effect'] = '';
            $this -> _malus = '';
            return $this -> hit($opposant);
        }
        $opposant ->damageRecieve(0);
        $this -> updateMalus();
    }

    public function updateMalus() {
        switch ($this -> _statuts['effect']) {
            case 'sleep':
                $this -> _malus = $this->getName() . ' dors pendant encore ' . $this -> getStatutsLonger() . ' tours';
            break;

            case 'poisoned':
                $this -> _malus = $this->getName() . ' est empoisonné pendant encore ' . $this -> getStatutsLonger() . ' tours';
            break;

        }
    }

    public function damageRecieve($damage) {
        if ((int) $damage){
            if($this-> _statuts['effect'] == 'poisoned'){
                $damage += 2;
            }
            $HP = $this->getHealthPoints();
            $HP -= $damage;
            $this -> _damageRecieve = "- " . $damage ." PV";
            $this->setHealthPoints($HP);
            return;
        }
        $this -> _damageRecieve = $damage;
        return;
    }
    
    public function getInfoAboutCharac()
    {
        $charac = [
            'name' => $this->getName(),
            'hp' => $this->getHealthPoints(),
            'damageRecieve' => $this->getDamageRecieve(),
            "malus" => $this -> _malus,
        ];
        return $charac;
    }
}
