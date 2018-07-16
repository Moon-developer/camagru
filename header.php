<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="camagru.css">
</head>

<div class="wrapper">
    <header class="header">
        <a href="index.php" id="title"><h1>Camagru</h1></a>
        <ul class="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="snap.php">Snap</a></li>
            <li><a href="gallery2.php">Gallery</a></li>
            <li><a href="user_settings.php">Settings</a></li>
            <?php if ($_SESSION[Username] && !empty($_SESSION[Username])): ?>
              <li><a href='user/ft_disconnect.php'>Sign out</a></li>
            <?php endif; ?>
        </ul>
    </header>

</html>
