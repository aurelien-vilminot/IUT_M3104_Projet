<div class="settings">
    <div>
        <form method="post">
            <label>Nombre maximum de discussions<br><br>Actuellement : <?=$nbMaxDiscussions?> discussions créables</label>
            <input type="text" id="littleInputBox" name="nbMaxDiscussions" placeholder="Entrer un nombre maximum de discussions" required>
            <?php
            if (isset($error_nbMaxDiscussions))
                echo <<<EOT
<p class="error">$error_nbMaxDiscussions</p>
EOT;
            ?>
            <input type="submit" id="littleSubmitBox" name="submit_nbMaxDiscussions" value="Modifier">
        </form>

        <form method="post">
            <label>Nombre maximum de messages par discussions<br><br>Actuellement : <?=$nbMaxMessages?> messages créables</label>
            <input type="text" id="littleInputBox" name="nbMaxMessages" placeholder="Entrer un nombre maximum de messages" required>
            <?php
            if (isset($error_nbMaxMessages))
                echo <<<EOT
<p class="error">$error_nbMaxMessages</p>
EOT;
            ?>
            <input type="submit" id="littleSubmitBox" name="submit_nbMaxMessages" value="Modifier">
        </form>
    </div>

    <div>
        <form method="post">
            <label>Nombre maximum d'utilisateurs par page dans la liste des utilisateurs<br><br>Actuellement : <?=$nbUsersByPage?> utilisateur(s) par page</label>
            <input type="text" id="littleInputBox" name="nbUsersByPage" placeholder="Entrer un nombre maximum d'utilisateurs par page" required>
            <?php
            if (isset($error_nbUsersByPage))
                echo <<<EOT
<p class="error">$error_nbUsersByPage</p>
EOT;
            ?>
            <input type="submit" id="littleSubmitBox" name="submit_nbUsersByPage" value="Modifier">
        </form>

        <form method="post">
            <label>Nombre maximum de discussions par page sur la page d'accueil<br><br>Actuellement : <?=$nbDiscussionsByPage?> discussion(s) par page</label>
            <input type="text" id="littleInputBox" name="nbDiscussionsByPage" placeholder="Entrer un nombre maximum de discussions par page" required>
            <?php
            if (isset($error_nbDiscussionsByPage))
                echo <<<EOT
<p class="error">$error_nbDiscussionsByPage</p>
EOT;
            ?>
            <input type="submit" id="littleSubmitBox" name="submit_nbDiscussionsByPage" value="Modifier">
        </form>
    </div>
</div>
<?php
if (isset($validate))
    echo <<<EOT
<p class="validate">$validate</p>
EOT;
?>