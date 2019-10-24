<section class="menu">
    <div class="topMenuBorder"></div>
    <div class="imgMenu">
        <?php
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
            echo <<<EOT
<a href="index.php"><img alt="Logo" src="media/logo_admin.png"></a>
EOT;
        else
            echo <<<EOT
<a href="index.php"><img alt="Logo" src="media/logo.png"></a>
EOT;
        ?>
    </div>
    <div class="middleMenuBorder"></div>
    <div class="pages">
        <?php
            if(isset($_SESSION['CurrentUser']))
            {
                echo <<<EOT
<a href="index.php?page=profil">Mon profil</a>
EOT;
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
                    echo <<<EOT
<a href="index.php?page=users">Liste des utilisateurs</a>
<a href="index.php?page=settings">Paramètres du site</a>
<a href="index.php?page=setDatabase">Administration base de données</a>
EOT;
                echo <<<EOT
<a href="index.php?page=logout">Déconnexion</a>
EOT;
            }
            else
                echo <<<EOT
<a href="connexion">Connexion</a>
<a href="inscription">Inscription</a>
EOT;
            ?>
    </div>
</section>