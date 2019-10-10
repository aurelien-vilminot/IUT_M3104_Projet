<?php

class Message{
  private $DataBase;
  private $Message;
  private $Number;
  private $Content;
  private $State


  public function __construct($login)
  {
      $this->DataBase = init_database();
      $this->login = $login;

      $sql = 'SELECT * FROM USER WHERE LOGIN = \'' . $this->login . '\'';
      $req = $this->DataBase->query($sql);
      while($row = $req->fetch())
      {
          $this->mail = $row['MAIL'];
          $this->password = $row['PASSWORD'];
          $this->admin = $row['ADMIN'];
      }
      $req->closeCursor();
  }


  public function __construct ($message){
    $this->Database = init_database();
    $this->Message $message;
    $sql = 'SELECT * FROM MESSAGE WHERE ID = \'' . $this->Message . '\'';
    $req = $this->DataBase->query($sql);
    while($row = $req->fetch())
    {
      $this->
    }
  }

}


?>
