<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <title>PHP tasks</title>
</head>

<body onload="openTask('<?php echo $_SESSION['taskName'] ?? null; ?>')">

    <header>
        <h1>WD_PS4_PHP</h1>
    </header>

    <div class="tabs">
        <button onclick="openTask('task1')">Task1</button>
        <button onclick="openTask('task2')">Task2</button>
        <button onclick="openTask('task3')">Task3</button>
        <button onclick="openTask('task4')">Task4</button>
        <button onclick="openTask('task5')">Task5</button>
        <button onclick="openTask('task6')">Task6</button>
    </div>

    <section class="main-content">

        <!--Task_1-->
        <div class="invisible" id="task1">
            <h2>Task 1</h2>
            <p>Сalculate a sum of all numbers from -1000 to 1000</p>
            <form action="handler.php" method="post">
                <input type="hidden" name="taskName" value="task1">
                <input type="submit" class="workspace_btn" value="Get sum">
            </form>
            <?php if (isset($_SESSION['task1'])): ?>
            <div class="workspace_out"><?php echo 'Result: ' . $_SESSION['task1']; ?></div>
            <?php endif; ?>
        </div>

        <!--Task_2-->
        <div class="invisible" id="task2">
            <h2>Task 2</h2>
            <p>Сalculate a sum of all numbers from -1000 to 1000<br>in which last digits ends in 2, 3, or 7</p>
            <form action="handler.php" method="post">
                <input type="hidden" name="taskName" value="task2">
                <input type="submit" class="workspace_btn" value="Get sum">
            </form>
            <?php if (isset($_SESSION['task2'])): ?>
            <div class="workspace_out"><?php echo 'Result: ' . $_SESSION['task2']; ?></div>
            <?php endif; ?>
        </div>

        <!--Task_3-->
        <div class="invisible" id="task3">
            <h2>Task 3</h2>
            <p>Draw a half of pyramid (50 rows)</p>
            <form action="handler.php" method="post">
                <input type="hidden" name="taskName" value="task3">
                <input type="submit" class="workspace_btn" value="Draw pyramid">
            </form>
            <?php if (isset($_SESSION['task3'])): ?>
            <div class="workspace_out" id="task3_out"><?php echo $_SESSION['task3']; ?></div>
            <?php endif; ?>
        </div>

        <!--Task_4-->
        <div class="invisible" id="task4">
            <h2>Task 4</h2>
            <p>Draw a chessboard of a given size</p>
            <form action="handler.php" method="post">
                <input type="hidden" name="taskName" value="task4">
                <input type="text" class="workspace_in" name="rows" title="chessboard rows" placeholder="chessboard rows">
                <input type="text" class="workspace_in" name="cols" title="chessboard columns" placeholder="chessboard columns">
                <input type="submit" class="workspace_btn" value="Draw chessboard">
            </form>
            <?php if (isset($_SESSION['task4'])): ?>
            <div class="workspace_out">
                <?php echo str_replace(['{black}', '{white}', '{start}', '{end}'],
                    ['<div class=chessboard__col_black></div>',
                        '<div class=chessboard__col_white></div>',
                        '<div class=chessboard__row>', '</div>'],
                    $_SESSION['task4']); ?>
            </div>
            <?php elseif (isset($_SESSION['errTask4'])): ?>
            <div class="error"><?php echo $_SESSION['errTask4']; ?></div>
            <?php endif; ?>
        </div>

        <!--Task_5-->
        <div class="invisible" id="task5">
            <h2>Task 5</h2>
            <p>Calculate a sum of digits of input number</p>
            <form action="handler.php" method="post">
                <input type="hidden" name="taskName" value="task5">
                <input type="text" class="workspace_in" name="number" title="number" placeholder="number">
                <input type="submit" class="workspace_btn" value="Get sum of digits">
            </form>
            <?php if (isset($_SESSION['task5'])): ?>
            <div class="workspace_out"><?php echo 'Result: ' . $_SESSION['task5']; ?></div>
            <?php elseif (isset($_SESSION['errTask5'])): ?>
            <div class="error"><?php echo $_SESSION['errTask5'] ?></div>
            <?php endif; ?>
        </div>

        <!--Task_6-->
        <div class="invisible" id="task6">
            <h2>Task 6</h2>
            <p>Get array of random numbers, get unique numbers, sort and reverse array</p>
            <form action="handler.php" method="post">
                <input type="hidden" name="taskName" value="task6">
                <input type="submit" class="workspace_btn" value="Get sorted array">
            </form>
            <?php if (isset($_SESSION['task6'])): ?>
            <div class="workspace_out"><?php print_r($_SESSION['task6']); ?></div>
            <?php endif; ?>
        </div>

    </section>

    <script>
        function openTask(taskID) {
            const workspaces = document.getElementsByClassName('workspace');
            for (let i = workspaces.length; i--;) {
                workspaces[i].className = 'invisible';
            }

            const element = document.getElementById(taskID);
            if (element !== null) {
                element.className = 'workspace';
            }
        }
    </script>
</body>
</html>