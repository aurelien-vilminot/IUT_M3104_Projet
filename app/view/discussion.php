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
        <div>

EOT;
            if ($message['STATE'] == '1')
                echo <<<EOT
            <img src="media/continue.png" alt="Continuer le message" title="Le message peut être complété">
        </div>
    </div>
</div>
EOT;
            else
                echo <<<EOT
            <img src="media/close_message.png" alt="Message clos" title="Le message est clos">
        </div>
    </div>
</div>

EOT;
        }
    ?>
</div>

<?php
    if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
    {
?>
        <form method="post">
            <input type="text" placeholder="Entrer votre message" name="message">
            <input type="submit" name="submit" value="Envoyer">
            <input type="submit" name="submit_close" value="Envoyer et clore le message">
        </form>
<?php
    }

