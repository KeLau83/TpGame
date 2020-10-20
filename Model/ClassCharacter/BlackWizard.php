<?php 
namespace App\Model\ClassCharacter;

use App\Model\Charactere;

class BlackWizard extends Charactere{
    
    public function __construct($name = null)
    {
        parent::__construct($name, 'BlackWizard');
    }

    public function hydrate(array $dataUsers)
    {
        parent::hydrate($dataUsers);
    }
    
    public function doIThrowSpell() {
        $probability = rand(1, 100);
        if($probability <= 10) {
            return true;
        }
        return null;
    }
    public function throwSpellOn(Charactere $opposant, $turnStatuts) {
        $opposant -> setStatuts('poisoned', $turnStatuts);
    }

    public function hit($opposant, $turnStatuts = 2){
        $statuts = $this -> getStatutEffect();
        if ($statuts != ''){
            $damage = $this -> updateStatuts($opposant);
            return;
        }
        $casting = $this -> doIThrowSpell();
        if($casting) {
            $this -> throwSpellOn($opposant, $turnStatuts);
            $damage = $this -> getName() . ' a empoisonné son adversaire pendant 2 tours';
            $opposant -> damageRecieve($damage);
        }else {
            parent::hit($opposant);
        }
        return ;
    }
}

    