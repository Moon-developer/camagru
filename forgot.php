<?php
  if ($_GET[err]) {
      echo '<script>alert("'.htmlentities($_GET[err]).'");window.location.href = "forgot.php";</script>';
  }
  include_once 'header.php';
?>
<title>Change password</title>
  <article class="main">

    <form class="login" action="user/ft_changepass.php" method="post">
      <label><b>Username</b></label>
      <input class="form" type="text" placeholder="Enter Username" name="login" required autofocus="autofocus" tabindex="1">

      <label><b>Password</b></label>
      <input class="form" type="password" placeholder="Enter Password" name="passwd" required tabindex="2">

      <label><b>Re-type the password</b></label>
      <input class="form" type="password" placeholder="Enter Password" name="passwd2" required tabindex="3">
      <?php if ($_GET[hash] && $_GET[email]): ?>
        <input type='hidden' name='email' value='<?=$_GET[email]?>'>
        <input type='hidden' name='hash' value='<?=$_GET[hash]?>'>
      <?php endif; ?>
      <button type="submit" class="button" tabindex="4">Change your password</button>
    </form>
  </article>
</div>
