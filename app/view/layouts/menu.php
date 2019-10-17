<section class="menu">
    <div class="topMenuBorder"></div>
    <div class="imgMenu">
        <a href="index.php"><img alt="Logo" src="media/logo.png"></a>
    </div>
    <div class="middleMenuBorder"></div>
    <div class="pages">
        <?php
            if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
                echo <<<EOT
<a href="index.php?page=profil">Mon profil</a>
<a href="index.php?page=logout">Déconnexion</a>
EOT;
            else
                echo <<<EOT
<a href="index.php?page=login">Connexion</a>
<a href="index.php?page=register">Inscription</a>
EOT;
            ?>
    </div>
</section>