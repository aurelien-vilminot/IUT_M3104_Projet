<?php

<?php
    if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
        header('Location: index.php');

    if(isset($_POST['word']))
    {
      require_once '../app/model/message.php';
      $message
    }

?>
