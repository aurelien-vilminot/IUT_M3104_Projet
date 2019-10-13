<div class="messages">
    <?php
    foreach ($tabMessages as &$message)
    {
?>
        <div class="message">
            <p><?=$message['CONTENT']?></p>
        </div>
<?php
    }
?>
</div>

