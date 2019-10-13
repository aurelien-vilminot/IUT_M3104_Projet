<?php

    require_once '../app/model/discussions.php';
    require '../app/model/user.php';

    $myDiscussions = new Discussion();
    $myDiscussion = new User('aurelien1');
    $tabDisc = $myDiscussions->getAllDiscussion();

    require '../app/view/home.php';

