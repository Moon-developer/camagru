<?php

  header('Location: ../index.php');
  include_once '../config/database.php';

  if (empty($_POST[login]) || empty($_POST[mail]) || empty($_POST[passwd]) || empty($_POST[passwd2])) {
      header("Location: ../create.php?err=Please, fill all the fields.\n");
      exit();
  }

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare('SELECT COUNT(*) FROM users WHERE login = :login');
      $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
      $sth->execute();
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }

  if ($sth->fetchColumn()) {
      header("Location: ../create.php?err=Login already taken.\n");
      exit();
  }
  if ($_POST[passwd] != $_POST[passwd2]) {
      header("Location: ../create.php?err=Passwords do not match.\n");
      exit();
  }
  $passwd = hash(SHA256, $_POST[passwd]);
  $hash = md5(rand(0, 1000));

  try {
      $sth = $dbh->prepare('INSERT INTO users (login, mail, passwd, state) VALUES (:login, :mail, :passwd, :hash)');
      $sth->bindParam(':login', $_POST[login], PDO::PARAM_STR);
      $sth->bindParam(':mail', $_POST[mail], PDO::PARAM_STR);
      $sth->bindParam(':passwd', $passwd, PDO::PARAM_STR);
      $sth->bindParam(':hash', $hash, PDO::PARAM_STR);
      $sth->execute();
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }
  
  $to = $_POST[mail];
  $subject = 'Camagru - Registration';
  $message = "

  Your account has been created, you can sign in with the following ID after activating your account.

  ------------------------
  Username: '$_POST[login]'
  ------------------------

  Click on the following link to activate your account:
  http://localhost:8080/Camagru/verify.php?email=$_POST[mail]&hash=$hash

  ";

  $headers = 'From:marco@student.wethinkcode.co.za'."\r\n";
  if (mail($to, $subject, $message, $headers))
    header("Location: ../index.php?err=Your account was created. Please activate it with the link sent on your email.\n");
  else
    header("Location: ../index.php?err=The activation email was not created.\n");