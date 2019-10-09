<?php
include 'user.php';

class Admin extend User {

  public _construct () {};


  public function open_discussion()
  {

  }

  public function close_discussion()
  {

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


  public function create_discussion ($discussion, $state)
  {
    if($state)
    {
      $discussion.open_discussion();
    }
    else {
      $discussion.close_discussion();
    }
  }

  public function  read_discussion ($discussion)
  {

  }

  public function  update_discussion ($discussion)
  {

  }

  public function delete_discussion ($discussion)
  {

  }

  public function create_message ($message)
  {

  }

  public function read_message ($message)
  {

  }

  public function update_message ($message)
  {

  }

  public function delete_message ($message)
  {

  }

}


?>
