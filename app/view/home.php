<div class="home">
    <div class="presentation">
        <p>
            Bienvenue sur FreeNote<b><?php if (isset($userLogin)) echo ' ' . $userLogin;?></b>,<br><br>
            Ce réseau social a pour vocation d'être inutile... Mais bon on n'a pas le choix de le faire, désolé les gars :(<br><br>
            Plus sérieusement, réseau social d’un nouveau genre, FreeNote consiste à créer des fils de discussions comprenant des messages participatifs au sein desquels chaque utilisateur ne peut ajouter qu’un ou deux mots.
        </p>
    </div>

    <div class="discussions">
        <table>
            <tr>
                <th>Discussion</th>
                <th>État</th>
            </tr>
            <?php
                foreach ($tabDisc as &$discussion)
                {
                    echo '<tr>';
                    for ($i = 1 ; $i < 3 ; ++$i)
                    {
                        if ($discussion[$i] == '0')
                            echo '<td><img src="media/close.png" alt="close" title="Cette discussion est close"></td>';
                        elseif ($discussion[$i] == '1')
                            echo '<td><img src="media/open.png" alt="open" title="Cette discussion est ouverte"></td>';
                        else
                            echo '<td><a href="index.php?page=discussion&id=' . $discussion[0] . '">' . $discussion[$i] . '</a></td>';
                    }
                    echo '</tr>';
                }
            ?>
        </table>
        <?php
        if (isset($_SESSION['user']) && $_SESSION['user'] == 1 && !isset($_GET['action']))
        {
            echo <<<EOT
<div class="newDiscussion">
    <img src="media/new.png">
    <a href="index.php?page=home&disc=$page_disc&action=newdiscussion">Nouvelle discussion</a>
</div>
EOT;
        }
        elseif (isset($_SESSION['user']) && $_SESSION['user'] == 1 && isset($_GET['action']) == 'newdiscussion')
        {
            echo <<<EOT
<form action="" method="post">
    <input type="text" placeholder="Entrez le titre de la discussion" name="titleDiscussion">
    <input type="submit" name="newDiscussion" value="Créer cette discussion">
</form>
EOT;
            if (isset($error_nb_discussions))
                echo <<<EOT
<p class="error">$error_nb_discussions</p>
EOT;
        }
        ?>
        <div class="prev_next">
            <?php
                if ($page_disc == 1)
                    echo <<<EOT
<img src="media/prev_gray.png" alt="prev" id="imgWithoutLink">
EOT;
                else {
                    $page_prev = $page_disc - 1;
                    echo <<<EOT
<a href="index.php?page=home&disc=$page_prev"><img src="media/prev.png" alt="prev"  title="Afficher les discussions précédentes"></a>
EOT;
                }

            if ($page_disc == $nbDiscussionsPages)
                echo <<<EOT
<img src="media/next_gray.png" alt="next" id="imgWithoutLink">
EOT;
            else {
                $page_next = $page_disc + 1;
                echo <<<EOT
<a href="index.php?page=home&disc=$page_next"><img src="media/next.png" alt="next"  title="Afficher les discussions suivantes"></a>
EOT;
            }
            ?>
        </div>
    </div>
</div>
