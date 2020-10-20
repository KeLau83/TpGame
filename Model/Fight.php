<?php 
namespace App\Model;
class Fight {

    public function cheCkIfThereAreWinner(Charactere $charac1,Charactere  $charac2) {
        $hpCharac1 = $charac1 -> getHealthPoints();
        $hpCharac2 = $charac2 -> getHealthPoints();
        $winner = null;
        if ($hpCharac1 == 0 && $hpCharac2 == 0){
            $winner = "Égalité";
        }elseif($hpCharac1 == 0) {
            $winner = $charac2 -> getName();
        }elseif ($hpCharac2 == 0){
            $winner = $charac1 -> getName();
        }
        return $winner;
    }

}