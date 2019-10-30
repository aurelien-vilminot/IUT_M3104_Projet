<div class="messages">
    <?php
        foreach ($tabMessages as &$message)
        {
            $content = $message['CONTENT'];
            echo <<<EOT
<div class="message_state">
    <div class="message">
        <p>$content</p>
    </div>
    <div class="infos">
EOT;
            $UsersForThisMessage = $tabUsersMessage[$message['ID']];
            if (count($UsersForThisMessage) == 0)
                $users = 'Utilisateur supprimé';
            else
                foreach ($UsersForThisMessage as &$Users)               // Pour chaque message, on concatène dans une variable ses expéditeurs
                {
                    if (!isset($users))
                        $users = 'Message envoyé par : ' . $Users['ID_USER'];
                    else
                        $users = $users . ', ' .$Users['ID_USER'];
                }

            echo <<<EOT
<div>
     <img src="media/infos.png" alt="Informations message" title="$users">
</div>
EOT;
            unset($users);
            if (isset($_SESSION['CurrentUser']) && $myUser->isAdmin())
            {
                $idMessage = $message['ID'];
                echo <<<EOT
        <div>
            <a href="discussion-$idPage-modify_message-$idMessage"><img src="media/modify.png" title="Modifier le message" alt="Modifier le message"></a>
            <a href="discussion-$idPage-delete_message-$idMessage"><img src="media/delete.png" title="Supprimer le message" alt="Supprimer le message"></a>
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
            if (isset($_GET['id_message']) && $message['ID'] == $_GET['id_message'])
            {
                if (isset($_SESSION['CurrentUser']) && $myUser->isAdmin() && isset($_GET['action']) &&  $_GET['action'] == 'modify_message')
                {
                    echo <<<EOT
<form action="discussion-$idPage-modify-$idMessage" method="post">
    <input type="text" placeholder="Entrez le nouveau contenu" name="messageContent" required>
    <input type="submit" name="modify_message" value="Modifier ce message">
</form>
EOT;
                }
            }
        }
    ?>
</div>

<?php
    if(isset($_SESSION['CurrentUser']))
    {
        if ($stateDiscussion == 1)
        {
            ?>
            <form action="discussion-<?=$idPage?>" method="post">
                <input type="text" placeholder="Entrer un ou deux mots" name="message" required>
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
<a href="discussion-$idPage-changeLikeSate"><img src="media/like.png" alt="Logo like" id="like"></a>
EOT;
                else
                    echo <<<EOT
<a href="discussion-$idPage-changeLikeSate"><img src="media/unlike.png" alt="Logo dislike" id="like"></a>
EOT;
                if ($myUser->isAdmin())
                {
                    echo <<<EOT
 <a href="discussion-$idPage-close_discussion" class="warning">• Fermer la discussion •</a>
EOT;
                }
        }
        else
            if ($myUser->isAdmin())
                echo <<<EOT
 <a href="discussion-$idPage-open_discussion" class="warning">• Ouvrir la discussion •</a>
EOT;
            else
                echo '<p>Cette discussion est maintenant fermée, allez en créer une nouvelle !</p>';
    }
    else
        echo '<p><a href="register">Inscrivez-vous</a> ou <a href="login">connectez-vous</a> si vous souhaitez participer à cette discusion';

    if (isset($_SESSION['CurrentUser']) && $myUser->isAdmin())
    {
?>
        <a href="discussion-<?=$_GET['id']?>-delete_discussion" class="warning">• Supprimer la discussion •</a>
<?php
    }
