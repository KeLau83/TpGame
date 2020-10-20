<?php

namespace App\Model;
use \PDO;
use App\Model\Charactere;

class CharactereManager
{
  private $_db; 

  

  public function __construct($db) {
    $this->_db = $db;
  }

  public function add(Charactere $charactere)
  {
    $q = $this->_db->prepare('INSERT INTO characters(id, name, healthPoints, Class) VALUES(:id, :name, :healthPoints, :Class)');
    $q->bindValue(':id', $charactere->getId(), PDO::PARAM_INT);
    $q->bindValue(':name',$charactere->getName());
    $q->bindValue(':healthPoints', $charactere->getHealthPoints(), PDO::PARAM_INT);
    $q->bindValue(':Class', $charactere->getCLass());

    $q->execute();
  }

  public function storeCharacInSession($charac) {
    if(isset( $_SESSION['Charac1'])){
      $_SESSION['Charac2'] =  serialize($charac);
      header("Location: index.php?action=fight");
    }else{
      $_SESSION['Charac1'] =  serialize($charac);
      header("Location: index.php?");
    } 
  }

  public function delete(Charactere $characteres)
  {
    $q = $this->_db->prepare('DELETE FROM characters WHERE name = ?');
    $q -> execute(array($characteres -> getName()));
  }

  public function get($id)
  {
    $id = (int)$id;
    $q = $this->_db->query('SELECT * FROM characters WHERE id = '. $id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    $class = $donnees['Class'];
    $class = 'App\\Model\\ClassCharacter\\' . $class;
    $charac = new $class();
    $charac -> hydrate($donnees);
    return $charac;
  }
    

  public function getList()
  {
    $charactere = [];

    $q = $this->_db->query('SELECT * FROM characters ORDER BY id');

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
      $class = $data['Class'];
      $class = 'App\\Model\\ClassCharacter\\' . $class;
      $charact = new $class;
      $charact -> hydrate($data);
      $charactere[] = $charact;
    }

    return $charactere;
  }

  public function update(Charactere $charactere)
  {
    $q = $this->_db->prepare('UPDATE characters SET name = :name, healthPoints = :healthPoints, LVL = :LVL, EXP = :EXP, ExpRequire = :ExpRequire, strength = :strength WHERE name= :name');
    $q->bindValue(':name',$charactere->getName());
    $q->bindValue(':healthPoints', $charactere->gethealthPoints(), PDO::PARAM_INT);
    $q->bindValue(':LVL', $charactere->getLVL(), PDO::PARAM_INT);
    $q->bindValue(':EXP', $charactere->getExp(), PDO::PARAM_INT);
    $q->bindValue(':ExpRequire', $charactere->getExpRequire(), PDO::PARAM_INT);
    $q->bindValue(':strength', $charactere->getStrength(), PDO::PARAM_INT);


    $q->execute();
  }

  public function storeWinner($winner, $charac1, $charac2) {
    if($winner == "Égalité"){
      $this -> delete($charac2);
      $this -> delete($charac1);
    }elseif($winner == $charac1->getName()){
      $charac1 -> updateHealth();
      $charac1 -> updateExp();
      $this -> update($charac1);
      $this -> delete($charac2);
    }elseif($winner == $charac2->getName()){
      $charac2 -> updateHealth();
      $charac2 -> updateExp();
      $this -> update($charac2);
      $this -> delete($charac1);
    }
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}