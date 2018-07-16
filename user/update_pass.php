<?php
  header('Location: ../index.php');
  include_once '../config/database.php';
  session_start();

  if (empty($_POST[passwd]) || empty($_POST[new_passwd]) || empty($_POST[new_passwd1])) {
      header("Location: ../index.php?err=Please, fill all the fields.\n");
      exit();
  }
  if ($_POST[new_passwd] != $_POST[new_passwd1]) {
      header("Location: ../index.php?err=New password do not match.\n");
      exit();
  }

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare('SELECT * FROM users WHERE login = :login');
      $sth->bindParam(':login', $_SESSION[Username], PDO::PARAM_STR);
      $sth->execute();
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }

  if ($sth->rowCount() != 1) {
      header("Location: ../index.php?err=The account does not exist.\n");
      exit();
  }
  $new_passwd = hash(SHA256, $_POST[new_passwd]);

  if ($sth->fetchColumn()) {
      try {
          $sth = $dbh->prepare("UPDATE users SET passwd = :new_passwd WHERE login = :login");
          $sth->bindParam(':login', $_SESSION[Username], PDO::PARAM_STR);
          $sth->bindParam(':new_passwd', $new_passwd, PDO::PARAM_STR);
          $sth->execute();
      } catch (PDOException $e) {
          echo 'Error: '.$e->getMessage();
          exit;
      }
      header("Location: ../index.php?err=Your password has been correctly changed.\n");
  } else {
      header("Location: ../index.php?err=Error.\n");
  }
?>