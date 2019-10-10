<?php
    if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
    {
        echo 'tu es connecté !';
    }

    require '../app/view/home.php';

