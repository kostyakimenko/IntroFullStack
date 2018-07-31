<?php
session_start();
$session = $_SESSION;
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <script>
        function openTask(taskID) {
            const workspaces = document.getElementsByClassName("workspace");
            for (let i = 0, length = workspaces.length; i < length; i++) {
                workspaces[i].style.display = "none";
            }

            const element = document.getElementById(taskID);
            if (element !== null) {
                element.style.display = "flex";
            }
        }
    </script>
    <title>PHP tasks</title>
</head>

<body onload="openTask('<?php echo $session['taskName']; ?>')">

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
        <div class="workspace" id="task1">
            <h2>Task 1</h2>
            <p>Сalculate a sum of all numbers from -1000 to 1000</p>
            <form action="handler.php" method="post">
                <input type="submit" class="workspace_btn" name="task1_submit" value="Get sum">
            </form>
            <div class="workspace_out">
                <?php echo $session['task1']; ?>
            </div>
        </div>

        <!--Task_2-->
        <div class="workspace" id="task2">
            <h2>Task 2</h2>
            <p>Сalculate a sum of all numbers from -1000 to 1000<br>in which last digits ends in 2, 3, or 7</p>
            <form action="handler.php" method="post">
                <input type="submit" class="workspace_btn" name="task2_submit" value="Get sum">
            </form>
            <div class="workspace_out">
                <?php echo $session['task2']; ?>
            </div>
        </div>

        <!--Task_3-->
        <div class="workspace" id="task3">
            <h2>Task 3</h2>
            <p>Draw a half of pyramid (50 rows)</p>
            <form action="handler.php" method="post">
                <input type="submit" class="workspace_btn" name="task3_submit" value="Draw pyramid">
            </form>
            <div class="workspace_out" id="task3_out">
                <?php echo $session['task3']; ?>
            </div>
        </div>

        <!--Task_4-->
        <div class="workspace" id="task4">
            <h2>Task 4</h2>
            <p>Draw a chessboard of a given size</p>
            <form action="handler.php" method="post">
                <input type="text" class="workspace_in" name="rows" title="chessboard rows" placeholder="chessboard rows">
                <input type="text" class="workspace_in" name="cols" title="chessboard columns" placeholder="chessboard columns">
                <input type="submit" class="workspace_btn" name="task4_submit" value="Draw chessboard">
            </form>
            <div class="workspace_out">
                <?php echo $session['task4']; ?>
            </div>
        </div>

        <!--Task_5-->
        <div class="workspace" id="task5">
            <h2>Task 5</h2>
            <p>Calculate a sum of digits of input number</p>
            <form action="handler.php" method="post">
                <input type="text" class="workspace_in" name="number" title="number" placeholder="number">
                <input type="submit" class="workspace_btn" name="task5_submit" value="Get sum of digits">
            </form>
            <div class="workspace_out">
                <?php echo $session['task5']; ?>
            </div>
        </div>

        <!--Task_6-->
        <div class="workspace" id="task6">
            <h2>Task 6</h2>
            <p>Get array of random numbers, get unique numbers, sort and reverse array</p>
            <form action="handler.php" method="post">
                <input type="submit" class="workspace_btn" name="task6_submit" value="Get sorted array">
            </form>
            <div class="workspace_out">
                <?php print_r($session['task6']); ?>
            </div>
        </div>

    </section>

</body>
</html>