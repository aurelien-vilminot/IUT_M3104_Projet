<div class="messages">
    <?php
        foreach ($tabMessages as &$message) {
            $content = $message['CONTENT'];
            echo <<<EOT
<div class="message_state">
    <div class="message">
        <p>$content</p>
    </div>
    <div class="infos">
        <div>
             <a href=""><img src="media/infos.png" alt="Informations message" title="Informations du message"></a>
        </div>
EOT;
            if (isset($_SESSION['CurrentUser']) && $myUser->isAdmin())
            {
                $idMessage = $message['ID'];
                echo <<<EOT
        <div>
            <a href="index.php?page=discussion&id=$idPage&action=delete_message&id_message=$idMessage"><img src="media/delete.png" alt="Delete Message"></a>
        </div>
EOT;
            }
            if ($message['STATE'] == '1')
                echo <<<EOT
        <div>
            <img src="media/continue.png" alt="Continuer le message" title="Le message peut être complété">
        </div>
    </div>
</div>
EOT;
            else
                echo <<<EOT
        <div>
            <img src="media/close_message.png" alt="Message clos" title="Le message est clos">
        </div>
    </div>
</div>
EOT;
        }
    ?>
</div>

<?php
    if(isset($_SESSION['CurrentUser']))
    {
        if ($stateDiscussion == 1)
        {
            ?>
            <form action="index.php?page=discussion&id=<?=$idPage?>" method="post">
                <input type="text" placeholder="Entrer un ou deux mots" name="message">
                <input type="submit" id="littleSubmitBox" name="submit" value="Envoyer">
                <input type="submit" name="submit_close" value="Envoyer et clore le message">
                <?php
                if (isset($error))
                    echo <<<EOT
<p class="error">$error</p>
EOT;
                ?>
            </form>
            <?php
                if($like)
                    echo <<<EOT
<a href="index.php?page=discussion&id=$idPage&action=changeLikeSate"><img src="media/like.png" alt="Logo like" id="like"></a>
EOT;
                else
                    echo <<<EOT
<a href="index.php?page=discussion&id=$idPage&action=changeLikeSate"><img src="media/unlike.png" alt="Logo dislike" id="like"></a>
EOT;
            if (isset($_SESSION['CurrentUser']) && $myUser->isAdmin())
                {
                    echo <<<EOT
 <a href="index.php?page=discussion&id=$idPage&action=close_discussion" class="warning">• Fermer la discussion •</a>
EOT;
                }
        }
        else
            echo '<p>Cette discussion est maintenant fermée, allez en créer une nouvelle !</p>';
    }
    else
        echo '<p><a href="index.php?page=register">Inscrivez-vous</a> ou <a href="index.php?page=login">connectez-vous</a> si vous souhaitez participer à cette discusion';

    if (isset($_SESSION['CurrentUser']) && $myUser->isAdmin())
    {
?>
        <a href="index.php?page=discussion&id=<?=$_GET['id']?>&action=delete_discussion" class="warning">• Supprimer la discussion •</a>
<?php
    }
