<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nobel Gimnázium</title>
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT?>css/main_style.css">
    </head>
    <body>
        <header>
            <h1 class="header">NOBEL GIMNÁZIUM</h1>
        </header>
        <nav>
            <?php echo Menu::getMenu($viewData['selectedItems']); ?>
        </nav>
        <div class="image-container">
        <img src="img/school.jpg" alt="school img" width="170" height="150">
        </div>
        <section>
            <?php include($viewData['render']); ?>
        </section>
        <footer>&copy; Nobel Gimnázium Alapítva: 1789. <?= date("Y") ?></footer>
    </body>
</html>
