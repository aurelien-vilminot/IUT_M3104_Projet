<?php

    require_once '../app/model/home.php';
    $myHome = new Home();
    $tabDisc = $myHome->getAllDiscussion();
    echo $tabDisc[0][0] . ' ' . $tabDisc[0][1] .PHP_EOL;
    echo $tabDisc[1][0] . ' ' . $tabDisc[1][1] .PHP_EOL;
    echo $tabDisc[2][0] . ' ' . $tabDisc[2][1] .PHP_EOL;

    require '../app/view/home.php';

