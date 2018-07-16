<?php
include_once '../config/database.php';
session_start();
if ($_POST['chkd'] != ""){
    $sub = 1;
}
else
    $sub = 0;
try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare('UPDATE users SET Sub = :sub WHERE login = :login');
      $sth->bindParam(':login', $_SESSION[Username], PDO::PARAM_STR);
      $sth->bindParam(':sub', $sub, PDO::PARAM_STR);
      $sth->execute();
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }
if ($sub == 1)
      header("Location: ../index.php?err=Subscribed.\n");
else
      header("Location: ../index.php?err=Unsubscribed.\n");

?>