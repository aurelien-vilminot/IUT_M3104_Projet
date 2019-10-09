<?php
include 'user.php';

class Admin extend User {

  public _construct () {};


  public function open_discussion($discussion)
  {
    require '../app/model/db_connection.php';
    $sql = 'UPDATE DISCUSSION SET STATE = TRUE where ID = $discussion';
    mysqli_query($sql);
  }

  public function close_discussion($discussion)
  {
    require '../app/model/db_connection.php';
    $sql = 'UPDATE DISCUSSION SET STATE = FALSE where ID = $discussion';
    mysqli_query($sql);
  }

  public function open_message($message)
  {
    require '../app/model/db_connection.php';
    $sql = 'UPDATE MESSAGE SET STATE = TRUE where ID = $message';
    mysqli_query($sql);
  }

  public function close_discussion($message)
  {
    require '../app/model/db_connection.php';
    $sql = 'UPDATE MESSAGE SET STATE = FALSE where ID = $message';
    mysqli_query($sql);
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

  }


  public function create_discussion ($discussion)
  {

  }

  public function  read_discussion ($discussion)
  {

  }

  public function  update_discussion ($discussion, $state)
  {
    if($state)
    {
      $discussion.open_discussion($discussion);
    }
    else {
      $discussion.close_discussion($discussion);
    }
  }

  public function delete_discussion ($discussion)
  {
    $sql = 'DELETE FROM DISCUSSION WHERE ID = $discussion';
    mysqli_query($sql);
  }

  public function create_message ($message)
  {

  }

  public function read_message ($message)
  {

  }

  public function update_message ($message)
  {
    if($state)
    {
      $discussion.open_message($message);
    }
    else {
      $discussion.close_message($message);
    }
  }

  public function delete_message ($message)
  {
    $sql = 'DELETE FROM MESSAGE WHERE ID = $message';
    mysqli_query($sql);
  }

}


?>
