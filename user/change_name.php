<?php
  header('Location: ../index.php');
  include_once '../config/database.php';

  if (empty($_POST[login]) || empty($_POST[new_login]) || empty($_POST[new_login1])) {
      header("Location: ../index.php?err=Please, fill all the fields.\n");
      exit();
  }
  if ($_POST[new_login] != $_POST[new_login1]) {
      header("Location: ../index.php?err=New username do not match.\n");
      exit();
  }

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare('SELECT * FROM users WHERE login = :login');
      $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
      $sth->execute();
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }

  if ($sth->rowCount() != 1) {
      header("Location: ../index.php?err=The account does not exist.\n");
      exit();
  }

  if ($sth->fetchColumn()) {
      try {
          $sth = $dbh->prepare("UPDATE users SET login = :new_login WHERE login = :login");
          $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
          $sth->bindParam(':new_login', $_POST[new_login], PDO::PARAM_STR);
          if ($sth->execute())
          {
            session_start();
            $_SESSION['Username'] = $_POST[new_login];
          }
      } catch (PDOException $e) {
          echo 'Error: '.$e->getMessage();
          exit;
      }
      header("Location: ../index.php?err=Your username has been correctly changed.\n");
  } else {
      header("Location: ../index.php?err=Error.\n");
  }
?>