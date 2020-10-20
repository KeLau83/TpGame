<?php
namespace App\Controller;

use App\Model\Charactere;

class BackController {
   

public static function issetWithGet($info) {
    if (isset($_GET[$info])){
        return htmlspecialchars($_GET[$info]);
    }
    return null;
}

public static function issetWithPost($info) {
    if (isset($_POST[$info])){
        return htmlspecialchars($_POST[$info]);
    }
    return null;
}

protected function render($viewName, $viewData = [], $viewTemplate = 'template.php') {
    extract($viewData);
    ob_start();
    require('./View/' .$viewName);
    $content = ob_get_clean();
    require('./template/' .$viewTemplate);
}

public static function serverRequestIsPost() {
    if ($_SERVER['REQUEST_METHOD'] ==="POST"){
        return true;
    }
    return false;
}

public static function getFirstCharac() {
    if(isset($_SESSION['Charac1'])){
        $firstCharac = unserialize($_SESSION['Charac1']);
        $firstCharac = $firstCharac -> getName();
        return $firstCharac;
    }
    return null;
}
}