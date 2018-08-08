<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/vote.css" rel="stylesheet">
    <link href="css/fontawesome-free-5.1.0-web/css/all.css" rel="stylesheet">
    <title>Vote</title>
</head>
<body>

    <section class="vote">
        <h1 class="vote__header">Your favorite activity</h1>

        <form class="vote__form" action="handler.php" method="post">
            <div class="vote__select">
                <div class="vote__icon">
                    <label for="trav"><i class="fas fa-globe-americas"></i></label>
                </div>
                <label for="trav">Traveling</label>
                <input type="radio" name="activity" id="trav" value="Traveling" checked>
            </div>

            <div class="vote__select">
                <div class="vote__icon">
                    <label for="sports"><i class="fas fa-futbol"></i></label>
                </div>
                <label for="sports">Sports</label>
                <input type="radio" name="activity" id="sports" value="Sports">
            </div>

            <div class="vote__select">
                <div class="vote__icon">
                    <label for="game"><i class="fas fa-gamepad"></i></label>
                </div>
                <label for="game">Gaming</label>
                <input type="radio" name="activity" id="game" value="Gaming">
            </div>

            <div class="vote__select">
                <div class="vote__icon">
                    <label for="party"><i class="fas fa-cocktail"></i></label>
                </div>
                <label for="party">Partying</label>
                <input type="radio" name="activity" id="party" value="Partying">
            </div>

            <div class="vote__select">
                <div class="vote__icon">
                    <label for="sleep"><i class="fas fa-bed"></i></label>
                </div>
                <label for="sleep">Sleeping</label>
                <input type="radio" name="activity" id="sleep" value="Sleeping">
            </div>

            <input class="vote__btn" type="submit" value="Vote">
        </form>

        <?php if (isset($_SESSION['error'])): ?>
        <div class="vote__error"><?= $_SESSION['error']; ?></div>
        <?php endif; ?>
    </section>

</body>
</html>