<?php
require '../app/model/database.php';

class Message{
  private $DataBase;
  private $Message;
  private $Content;
  private $State
  private $Id_Discussion;

  private $Number;

  public function __construct ($message)
  {
    $this->Database = init_database();
    $this->Message $message;
    $sql1 = 'SELECT * FROM MESSAGE WHERE ID = \'' . $this->Message . '\'';
    $req = $this->DataBase->query($sql1);
    while($row = $req->fetch())
    {
      $this->Content = $row['CONTENT'];
      $this->State = $row['STATE'];
      $this->Id_Discussion = $row['ID_DISCUSSION'];
    }
  }


  public function getDataBase(){return $this->DataBase;}
  public function getMessage(){return $this->Message;}
  public function getContent(){return $this->Content;}
  public function getState(){return $this->State;}
  public function getId_Discussion(){return $this->Id_DIscussion;}

  public function close_message($message)
  {
    require '../app/model/db_connection.php';
    $sql = 'UPDATE MESSAGE SET STATE = FALSE WHERE ID = $message';
    $this->getDataBase()->query($sql);
  }

  public function open_message($message)
  {
    require '../app/model/db_connection.php';
    $sql = 'UPDATE MESSAGE SET STATE = TRUE where ID = $message';
    $this->getDataBase()->query($sql);
  }

}


?>
