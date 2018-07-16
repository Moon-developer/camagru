<?php

  include_once 'database.php';

try {
    $DB = explode(';', $DB_DSN);
    $database = substr($DB[1], 7);
    $dbh = new PDO("$DB[0]", $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->exec("CREATE DATABASE IF NOT EXISTS $database");
    echo "Database '$database' created successfully.<br>";
    $dbh->exec("use $database");
    $dbh->exec("CREATE TABLE IF NOT EXISTS users (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                                  login VARCHAR(255) NOT NULL,
                                                  mail VARCHAR(255) NOT NULL,
                                                  passwd VARCHAR(255) NOT NULL,
                                                  state VARCHAR(255) NOT NULL,
                                                  forgot VARCHAR(255) DEFAULT 'NULL')");
    echo "Table 'users' created successfully.<br>";
    $dbh->exec("CREATE TABLE IF NOT EXISTS snap  (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                                  login VARCHAR(255) NOT NULL,
                                                  img VARCHAR(255) NOT NULL)");
    echo "Table 'snap' created successfully.<br>";
    $dbh->exec("CREATE TABLE IF NOT EXISTS comments  (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                                  login VARCHAR(255) NOT NULL,
                                                  img_id VARCHAR(255) NOT NULL,
                                                  comment VARCHAR (255) NOT NULL)");
    echo "Table 'comments' created successfully.<br>";
    $dbh->exec("CREATE TABLE IF NOT EXISTS likes  (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                                  login VARCHAR(255) NOT NULL,
                                                  img_id VARCHAR(255) NOT NULL)");
    echo "Table 'likes' created successfully.<br>";
    $dbh->exec("ALTER TABLE `users` ADD `Sub` INT(1) NOT NULL DEFAULT '1' AFTER `forgot`");
    echo "Notifications succesfully added.<br>";
} catch (PDOException $e) {
    echo $sql.'<br>'.$e->getMessage();
}

  $dbh = null;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Camagru - Setup</title>
  </head>
  <body>
    <form action="../" class="inline">
        <button autofocus="autofocus" tabindex="1">Index</button>
    </form>
  </body>
</html>
