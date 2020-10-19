<?php
require ('./autoload.php');
session_start();

use App\Controller\BackController;
use App\Controller\FrontController;

$action = BackController::issetWithGet('action');

$frontController = new FrontController;
if ($action){
    switch($action){
        case 'fight' :
            $frontController -> fight();
            break;
        case 'Create' :
            $frontController -> Create();
            break;
        case 'Choose' :
            $frontController -> Choose();
            break;
    }
        
}else{
    $frontController -> home();
}
