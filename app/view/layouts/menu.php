<section class="menu">
    <div class="topMenuBorder"></div>
    <div class="imgMenu">
        <?php
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
            echo <<<EOT
<a href="home"><img alt="Logo" src="media/logo_admin.png"></a>
EOT;
        else
            echo <<<EOT
<a href="home"><img alt="Logo" src="media/logo.png"></a>
EOT;
        ?>
    </div>
    <div class="middleMenuBorder"></div>
    <div class="pages">
        <?php
            if(isset($_SESSION['CurrentUser']))
            {
                echo <<<EOT
<a href="profil">Mon profil</a>
EOT;
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
                    echo <<<EOT
<a href="users">Liste des utilisateurs</a>
<a href="settings">Paramètres du site</a>
<a href="setDatabase">Administration base de données</a>
EOT;
                echo <<<EOT
<a href="logout">Déconnexion</a>
EOT;
            }
            else
                echo <<<EOT
<a href="login">Connexion</a>
<a href="register">Inscription</a>
EOT;
            ?>
    </div>
</section>