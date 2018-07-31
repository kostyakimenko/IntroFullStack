<?php
session_start();
$errMsg = $_SESSION['error'];
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
            <table>
                <tr class="vote__select">
                    <th><label for="trav"><i class="fas fa-globe-americas"></i></label></th>
                    <th><label for="trav">Traveling</label></th>
                    <th><input type="radio" name="activity" id="trav" value="Traveling" checked></th>
                </tr>
                <tr class="vote__select">
                    <th><label for="sports"><i class="fas fa-futbol"></i></label></th>
                    <th><label for="sports">Sports</label></th>
                    <th><input type="radio" name="activity" id="sports" value="Sports"></th>
                </tr>
                <tr class="vote__select">
                    <th><label for="game"><i class="fas fa-gamepad"></i></label></th>
                    <th><label for="game">Gaming</label></th>
                    <th><input type="radio" name="activity" id="game" value="Gaming"></th>
                </tr>
                <tr class="vote__select">
                    <th><label for="party"><i class="fas fa-cocktail"></i></label></th>
                    <th><label for="party">Partying</th>
                    <th><input type="radio" name="activity" id="party" value="Partying"></th>
                </tr>
                <tr class="vote__select">
                    <th><label for="sleep"><i class="fas fa-bed"></i></label></th>
                    <th><label for="sleep">Sleeping</label></th>
                    <th><input type="radio" name="activity" id="sleep" value="Sleeping"></th>
                </tr>
            </table>
            <input class="vote__btn" type="submit" value="Vote">
        </form>

        <div class="vote__error">
            <?php echo $errMsg; ?>
        </div>
    </section>

</body>
</html>