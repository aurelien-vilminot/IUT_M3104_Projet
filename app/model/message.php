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
    $req->closeCursor();
  }


  public function getDataBase(){return $this->DataBase;}
  public function getMessage(){return $this->Message;}
  public function getContent(){return $this->Content;}
  public function getState(){return $this->State;}
  public function getId_Discussion(){return $this->Id_DIscussion;}

  public function getNumberMessage($discussion)
  {
    $sql = 'SELECT COUNT(*) FROM MESSAGE WHERE ID_DISCUSSION = $discussion';
    return $this->getDataBase()->query($sql);
  }

  public function close_message($message)
  {
    $sql = 'UPDATE MESSAGE SET STATE = FALSE WHERE ID = $message';
    $this->getDataBase()->query($sql);
  }

  public function open_message($message)
  {
    $sql = 'UPDATE MESSAGE SET STATE = TRUE where ID = $message';
    $this->getDataBase()->query($sql);
  }

  public function add_content($message,$content)
  {
    $sql1 = 'SELECT CONTENT FROM MESSAGE WHERE ID = $message'
    $prev = query($sql1);
    $sql2 = 'UPDATE MESSAGE SET CONTENT = $prev + $content WHERE MESSAGE = $message'
    $this->getDataBase()->query($sql2)
  }

}

?>
