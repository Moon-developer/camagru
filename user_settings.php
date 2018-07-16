<?php
  session_start();
  if ($_SESSION[Username] && !empty($_SESSION[Username])) {
      include_once 'header.php';
  } else {
      header('Location: index.php?err=You must login to access this page.');
  }
?>
<title>Preference</title>
  <article class="main">

    <form class="login" action="user/change_name.php" method="post">
      <label><b>Current Username</b></label>
      <input class="form" type="text" placeholder="Enter Username" name="login" required autofocus="autofocus" tabindex="1">
        <label><b>New Username</b></label>
      <input class="form" type="text" placeholder="Enter New Username" name="new_login" required autofocus="autofocus" tabindex="1">
        <label><b>Retype New Username</b></label>
      <input class="form" type="text" placeholder="Confirm New Username" name="new_login1" required autofocus="autofocus" tabindex="1">
        <button type="submit" class="button" tabindex="5">Change Username</button>
      </form>

    <form class="login" action="user/change_email.php" method="post">
      <label><b>Current Email</b></label>
        <input class="form" type="email" placeholder="Enter Email" name="mail_old" required tabindex="2">
      <label><b>New Email</b></label>
        <input class="form" type="email" placeholder="Enter New Email" name="new_mail" required tabindex="2">
      <label><b>Retype New Email</b></label>
        <input class="form" type="email" placeholder="Confirm New Email" name="new_mail1" required tabindex="2">
        <button type="submit" class="button" tabindex="5">Change Email</button>
      </form>

    <form class="login" action="user/update_pass.php" method="post">
      <label><b>Current Password</b></label>
        <input class="form" type="password" placeholder="Enter Password" name="passwd" required tabindex="3">
      <label><b>New Password</b></label>
        <input class="form" type="password" placeholder="Enter New Password" name="new_passwd" required tabindex="3">
      <label><b>Retype New Password</b></label>
        <input class="form" type="password" placeholder="Confirm New Password" name="new_passwd1" required tabindex="3">
      <button type="submit" class="button" tabindex="5">Change Password</button>
      </form>

    <form class="login" action="user/unsubscribe.php" method="post">
      <label><b>Get email notifcations?</b></label></br><br/>
      <label class="switch">
        <input type="checkbox" id="chkd" name="chkd">
        <span class="slider round"></span>
      </label>
    </br>
    <br/>
      <button type="submit" class="button" tabindex="5">Confirm Subscription Option</button>
    </form>
  </article>
</div>