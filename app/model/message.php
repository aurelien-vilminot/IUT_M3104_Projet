<?php
require_once '../app/model/database.php';

class Message extends DataBase {
    private $id;
    private $content;
    private $state;
    private $id_Discussion;

    private $Number;

    public function __construct ($message)
    {
      $this->id = $message;
      $sql1 = 'SELECT * FROM MESSAGE WHERE ID = \'' . $this->Message . '\'';
      $req = $this->executeRequete($sql1);
      while($row = $req->fetch())
      {
        $this->content = $row['CONTENT'];
        $this->state = $row['STATE'];
        $this->id_Discussion = $row['ID_DISCUSSION'];
      }
      $req->closeCursor();
    }

    public function getMessage(){return $this->Message;}
    public function getContent(){return $this->Content;}
    public function getState(){return $this->State;}
    public function getId_Discussion(){return $this->Id_DIscussion;}


    public function getNumberMessage($discussion)
    {
      $sql = 'SELECT COUNT(*) FROM MESSAGE WHERE ID_DISCUSSION = $discussion';
      return $this->executeRequete($sql);
    }

    public function close_message($message)
    {
      $sql = 'UPDATE MESSAGE SET STATE = FALSE WHERE ID = $message';
      $this->executeRequete($sql);
    }


    private function setstate($state,$message)
    {
      if($state)
      {
        $this->getMessage()->open_message($message);    #getMessage pas encore declarer
      }
      else {
        $this->getMessage()->close_message($message);    #getMessage pas encore declarer
      }
    }

    public function add_content($message,$content)
    {
      $sql1 = 'SELECT CONTENT FROM MESSAGE WHERE ID = $message';
      $prev = query($sql1);
      $concat = $prev . $content;
      $sql2 = 'UPDATE MESSAGE SET CONTENT = $concat WHERE MESSAGE = $message';
      $this->executeRequete($sql2);
    }
  }

