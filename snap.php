<?php
  session_start();
  if ($_SESSION[Username] && !empty($_SESSION[Username])) {
      include_once 'header.php';
  } else {
      header('Location: index.php?err=You must login to access this page.');
  }
?>
<script src="webcam.js" charset="utf-8"></script>
<title>Snap</title>
  <article class="main">
    <div class="videobox">
      <h3>Live</h3>
        <video id="video"></video>
        <img id="image" height="640px" width="480px" style="display: none;"/>
        <div id="canvasvideo"></div>
      <form id="img_filter">
        <label for="1">
          <input type="radio" name="img_filter" value="images/filters/1.png" id="1" onchange="show_img('1')">
          <img class="img" src="images/filters/11.png" height="128" width="128">
        </label>
        <label for="2">
          <input type="radio" name="img_filter" value="images/filters/2.png" id="2" onchange="show_img('2')">
          <img class="img" src="images/filters/22.png" height="128" width="128">
        </label>
        <label for="3">
          <input type="radio" name="img_filter" value="images/filters/3.png" id="3" onchange="show_img('3')">
          <img class="img" src="images/filters/33.png" height="128" width="128">
        </label>
        <label for="4">
          <input type="radio" name="img_filter" value="images/filters/4.png" id="4" onchange="show_img('4')">
          <img class="img" src="images/filters/44.png" height="128" width="128">
        </label>
      </form>
      <br/>
        <button class="button" id="snap" onclick="javascript:takeSnap()">Take picture</button>
      </br>
      <br/>
      <label for="upload_img" class="upload">upload</label>
      <input type='file' accept="image/*" onchange="readURL(this);" id="upload_img" style="visibility:hidden"/>
    <br/>
    <img id="image" height="640px" width="480px" style="display: none;"/>
  </div>
  </article>

  <aside class="aside2">
    <div class="videobox">
    <h3>Overview</h3>
    <div id="canvas"></div>
    <form method='post' accept-charset='utf-8' name='form'>
      <input name='img' id='img' type='hidden'/>
      <input name='user' id='user' type='hidden' value='<?=$_SESSION[Username];?>'/>
    </form>
  </div>
  </aside>
  <footer class="footer">
  </footer>
</div>
