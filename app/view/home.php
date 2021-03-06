<div class="home">
    <div class="presentation">
        <p>
            Bienvenue sur FreeNote<b><?php if (isset($userLogin)) echo ' ' . $userLogin;?></b>,<br><br>
            Ce réseau social a pour vocation d'être inutile... Mais bon, nous n'avions pas le choix, désolé les gars :(<br><br>
            Plus sérieusement, réseau social d’un nouveau genre, FreeNote consiste à créer des fils de discussions comprenant des messages participatifs au sein desquels chaque utilisateur ne peut ajouter qu’un ou deux mots.
        </p>
    </div>

    <div class="discussions">
        <table>
            <tr>
                <th>Discussions</th>
                <th>État</th>
                <th>Likes</th>
            </tr>
            <?php
                foreach ($tabDisc as &$discussion)
                {
                    echo '<tr>';
                    for ($i = 1 ; $i < 4 ; ++$i)
                    {
                        if ($i == 1)
                            echo '<td><a href="discussion-' . $discussion[0] . '">' . $discussion['TITLE'] . '</a></td>';
                        elseif ($i == 2)
                        {
                            if ($discussion['STATE'] == '0')
                                echo '<td><img src="media/close.png" alt="close" title="Cette discussion est close"></td>';
                            elseif ($discussion['STATE'] == '1')
                                echo '<td><img src="media/open.png" alt="open" title="Cette discussion est ouverte"></td>';
                        }
                        else
                            echo '<td>' . $discussion['NB_LIKE'] . '</td>';
                    }
                    echo '</tr>';
                }
            ?>
        </table>
        <?php
        if (isset($_SESSION['CurrentUser']) && (!isset($_GET['action']) || $_GET['action'] != 'newdiscussion'))
        {
            echo <<<EOT
<div class="newButton">
    <img src="media/new.png" alt="Logo nouvelle discussion">
    <a href="home-$page_disc-newdiscussion">Nouvelle discussion</a>
</div>
EOT;
        }
        elseif (isset($_SESSION['CurrentUser']) && isset($_GET['action']) && $_GET['action'] == 'newdiscussion')
        {
            echo <<<EOT
<form method="post">
    <input type="text" placeholder="Entrez le titre de la discussion" name="titleDiscussion" pattern=".{2,15}" required>
    <input type="submit" name="newDiscussion" value="Créer cette discussion">
</form>
EOT;
            if (isset($error))
                echo <<<EOT
<p class="error">$error</p>
EOT;
        }
        ?>
        <div class="prev_next_discussions">
            <?php
                if ($page_disc == 1)
                    echo '<img src="media/prev_gray.png" alt="prev" id="imgWithoutLinkDiscussion">';
                else
                {
                    $page_prev = $page_disc - 1;
                    echo <<<EOT
<a href="home-$page_prev"><img src="media/prev.png" alt="prev"  title="Afficher les discussions précédentes"></a>
EOT;
                }
                if ($page_disc == $nbDiscussionsPages)
                    echo '<img src="media/next_gray.png" alt="next" id="imgWithoutLinkDiscussion">';
                else
                {
                    $page_next = $page_disc + 1;
                    echo <<<EOT
<a href="home-$page_next"><img src="media/next.png" alt="next"  title="Afficher les discussions suivantes"></a>
EOT;
                }
            ?>
        </div>
    </div>
</div>

<?php
if (isset($subject))
{
    ?>
    <div id="validation" class="overlay">
        <div class="popup">
            <div class="head">
                <h2><?=$subject?></h2>
                <a class="close" href="#">&times;</a>
            </div>
            <div class="content">
                <p><?=$object?></p>
            </div>
        </div>
    </div>
    <?php
}
?>
