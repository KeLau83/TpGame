<?php
namespace App\Model;
class UserManager {
    public function gotAChamp(){
        if(isset($_SESSION['Charac1'])){
            return true;
        }
        return false;
    }
}