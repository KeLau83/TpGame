<?php
namespace App\Controller;

use App\Model\Charactere;
use App\Model\CharactereManager;
use App\Model\DataBase;
use App\Model\Fight;
use App\Model\UserManager;

class FrontController extends BackController{

    public function home() {

        $choose =  BackController::issetWithPost('choose');
        $userManager = new UserManager;
        $gotAChamp = $userManager -> gotAChamp();
        $charac1 = null;
        if($gotAChamp){
            $charac1 = unserialize($_SESSION['Charac1']);
        }

        $viewData =  [
            'gotAChamp' => $gotAChamp,
            'charac1' => $charac1
        ];
        $this -> render("home.php", $viewData);

        if($choose) {
            header("Location: index.php?action=$choose");
        } 
    }

    public function Create() {

       $nameCharac =  BackController::issetWithPost('Charac');
       $dataBase = new DataBase();
       $db = $dataBase -> connectToDB();
       $characManager = new CharactereManager($db);

       if (!($nameCharac)){
            $this -> render('createCharac.php');
            return;
        }

        $charac = new Charactere($nameCharac);
        $characManager -> add($charac);
        $characManager -> storeCharacInSession($charac); 
    }

    public function Choose() {

        $requestPost = BackController::serverRequestIsPost();
        $dataBase = new DataBase();
        $db = $dataBase -> connectToDB();
        $characManager = new CharactereManager($db);
        $allCharacStore = $characManager -> getList();

        if ($requestPost) {
            $id =  BackController::issetWithPost('Charac');
            $charac = $characManager -> get($id);  
            $characManager -> storeCharacInSession($charac); 
        }

        $firstCharac = BackController::getFirstCharac();    
        $viewData = [
            "allCharacStore" => $allCharacStore,
            "firstCharac" => $firstCharac
        ];
        $this -> render('chooseCharac.php', $viewData);
    }

    public function fight() {
        $fight = new Fight();
        $dataBase = new DataBase();
        $db = $dataBase -> connectToDB();
        $characManager = new CharactereManager($db);
        $charac1 = unserialize($_SESSION['Charac1']) ;
        $charac2 = unserialize($_SESSION['Charac2']);
        $fighter1 = $charac1 -> getInfoAboutCharac($charac2);
        $fighter2 = $charac2 -> getInfoAboutCharac($charac1);
        $winner = $fight -> cheCkIfThereAreWinner($charac1, $charac2);
        $viewData = [
            'fighter1' => $fighter1,
            'fighter2' => $fighter2,
            'winner' => $winner
        ];
        $_SESSION['Charac1'] =  serialize($charac1);
        $_SESSION['Charac2'] = serialize($charac2);
        $characManager -> storeWinner($winner, $charac1, $charac2);
        $this -> render('fight.php', $viewData);
    }
}

