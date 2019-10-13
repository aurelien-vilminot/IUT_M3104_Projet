<?php

    require_once '../app/model/home.php';
    $myHome = new Home();
    $tabDisc = $myHome->getAllDiscussion();
    echo $tabDisc[0][0] . $tabDisc[0][1];
    echo $tabDisc[1][0] . $tabDisc[1][1];
    echo $tabDisc[2][0] . $tabDisc[2][1];

    require '../app/view/home.php';

