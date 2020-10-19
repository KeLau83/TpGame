<?php
namespace App\Model;

use \PDO;

class DataBase {
    public function connectToDB($showSqlErrors = false) {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=tp_game;charset=utf8', 'root', '');
            if($showSqlErrors){
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $bdd;
        } catch (\Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }    
    }
}