<?php
require_once '../app/model/user.php';

class Admin extends User {


  public function __construct(){}


  public function open_discussion($discussion)
  {
    require '../app/model/db_connection.php';
    $sql = 'UPDATE DISCUSSION SET STATE = TRUE where ID = $discussion';
    $this->getDataBase()->query($sql);
  }

  public function close_discussion($discussion)
  {
    require '../app/model/db_connection.php';
    $sql = 'UPDATE DISCUSSION SET STATE = FALSE where ID = $discussion';
    $this->getDataBase()->query($sql);
  }

  public function create_user ($user)
  {
    new User($user);
  }

  public function read_user ($user)
  {

  }

  public function  update_user ($user)
  {

  }

  public function delete_user ($user)
  {
    require '../app/model/db_connection.php';
    $sql = 'DELETE FROM USER WHERE LOGIN = $user';
    $this->getUser()->query($sql);
  }

  public function  read_discussion ($discussion)
  {

  }


  public function delete_discussion ($discussion)
  {
    require '../app/model/db_connection.php';
    $sql = 'DELETE FROM DISCUSSION WHERE ID = $discussion';
    $this->getDiscussion()->query($sql);      #getDiscussion pas encore creer
  }

  public function delete_message ($message)
  {
    require '../app/model/db_connection.php';
    $sql = 'DELETE FROM MESSAGE WHERE ID = $message';
    $this->getDiscussion()->query($sql);       #getDiscussion pas encore creer
  }

}


?>
