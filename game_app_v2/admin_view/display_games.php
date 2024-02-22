<?php
require_once('../controller/game.php');
require_once('../controller/game_controller.php');

$games = GameController::getAllGames();
?>
<html>
<head>
<link rel="icon" href="../admin_view/images/gri.png" type="image/png">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Available Games to rate</title>
</head>

<body>
<div class="background-image"></div>
    <h1>Available games to rate</h1>
    <h1>Available Games</h1>
    <table>
        <tr>
            <th>Game ID</th>
            <th>Game Play</th>
            <th>Game Name</th>
        </tr>
        <?php foreach ($games as $game) : ?>
        <tr>
            <td><?php echo $game->getGameNo(); ?></td>
            <td><a href="https://battleroyalegames.com/">GamePlay</a></td>
            <td><?php echo $game->getGameName(); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h1>Game Play Screen</h1>

    <video
            src="../Game_Play.mp4" controls controlist="nodownload"
            width="50%" height="50%" style="border:1px solid black;">
    </video>

    <h3><a href="display_admin.php">Home</a></h3>
</body>
</html>