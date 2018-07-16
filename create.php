<?php
  if ($_GET[err]){echo "<script>alert(\"".htmlentities($_GET[err])."\");window.location.href = \"create.php\";</script>";}
  include_once 'header.php';
?>
<title>Create an account</title>
  <article class="main">

    <form class="login" action="user/ft_create.php" method="post">
      <label><b>Username</b></label>
      <input class="form" type="text" placeholder="Enter Username" name="login" required autofocus="autofocus" tabindex="1">

      <label><b>E-mail adress</b></label>
      <input class="form" type="email" placeholder="Enter Email" name="mail" required tabindex="2">

      <label><b>Password</b></label>
      <input class="form" type="password" placeholder="Enter Password" name="passwd" required tabindex="3">

      <label><b>Re-type the password</b></label>
      <input class="form" type="password" placeholder="Enter Password" name="passwd2" required tabindex="4">

      <button type="submit" class="button" tabindex="5">Create your account</button>
    </form>
  </article>
</div>
