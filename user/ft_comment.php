<?php
  session_start();
  if (!$_SESSION['Username'] || empty($_SESSION['Username'])) {
      header('Location: index.php?err=You must login to access this page.');
      exit();
  }
  if (empty($_POST['comment']) || empty($_GET['img_id'])) {
      header("Location: ../gallery.php?page=$_GET[page]");
      exit();
  }
  include_once '../config/database.php';
  header("Location: ../gallery.php?page=$_GET[page]");

  try {
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $dbh->prepare('INSERT INTO comments (login, img_id, comment) VALUES  (:login, :img_id, :comment)');
    $sth->bindParam(':img_id', $_GET['img_id'], PDO::PARAM_INT);
    $sth->bindParam(':login', $_SESSION[Username], PDO::PARAM_STR);
    $sth->bindParam(':comment', $_POST[comment], PDO::PARAM_STR);
    $sth->execute();
    $sth = $dbh->prepare('SELECT users.mail FROM users INNER JOIN snap ON users.login = snap.login WHERE snap.id = :img_id');
    $sth->bindParam(':img_id', $_GET['img_id'], PDO::PARAM_INT);
    $sth->execute();
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }

  $mail = $sth->fetchColumn();
  $to = $mail;
  $subject = 'Camagru - New comment';
  $message = "

  A new comment has been posted on your photo by : $_SESSION[Username]

  Comment : $_POST[comment]

  ";
$sub = 1;
try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare('SELECT * FROM snap WHERE id = :img_id');
      $sth->bindParam(':img_id', $_GET['img_id'], PDO::PARAM_INT);
      $sth->execute();
      $result = $sth->fetchAll();
      $comentee = $result[0]['login'];
     echo '<script>';
  echo "console.log('got user name')";
  echo '</script>';
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }
try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $dbh->prepare('SELECT * FROM users WHERE login = :login AND Sub = 1');
      $sth->bindParam(':login', $comentee, PDO::PARAM_STR);
      $sth->execute();
      if ($sth->rowCount() != 1)
          $sub = 0;
    echo "Sub: $sub";
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      exit;
  }
  $headers = 'From:marco@student.wethinkcode.co.za'."\r\n";
  if ($sub == 1 && mail($to, $subject, $message, $headers))
    header("Location: ../index.php?err=An email notification has been sent for your comment.\n");
  else
    header("Location: ../index.php?err=The notification email was not created.\n");
