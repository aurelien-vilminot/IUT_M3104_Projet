<?php
    session_start();

    if(isset($_GET['page']) && !empty($_GET['page']))
            $page = $_GET['page'];
        else
            $page = 'home';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="FreeNote - Réseau Social">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FreeNote</title>
    <link rel="stylesheet" id="style" href="style/index.css" />
    <link rel="icon" type="image/png" href="media/favicon.png"/>
    <script src="js/myjavascript.js"></script>
</head>
<body>
    <?php require '../app/view/layouts/menu.php' ?>
    <main>
        <div class="topMainBorder"></div>

        <section class="data">
            <h1>FreeNote</h1>
            <?php require '../app/control/' . $page . '.php'?>
        </section>

        <?php require '../app/view/layouts/footer.php' ?>
    </main>
</body>
</html>
