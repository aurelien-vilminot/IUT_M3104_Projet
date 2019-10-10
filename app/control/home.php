<?php
    if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
    {
        require_once '../app/model/discussions.php';

        $myDiscussions = new Discussion();
        $tabDisc = $myDiscussions->getAllDiscussion();
   }



    require '../app/view/home.php';

