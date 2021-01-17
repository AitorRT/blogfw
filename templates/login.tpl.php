<?php
include 'header.tpl.php';
?>
<main class="container">
  <form action="<?=BASE?>login/log" method="POST">
    <div class="form-group">
      <label for="uname">Username</label>
      <input type="text" class="form-control" name="uname" id="uname" aria-describedby="unameHelp" placeholder="Enter username" required>
    </div>
    <div class="form-group">
      <label for="pass">Password</label>
      <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" required>
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" name="remember" id="remember">
      <label class="form-check-label" for="remember">Remember me</label>
    </div>
    <button type="submit" class="btn btn-primary">Log in</button>
  </form>
</main>
<?php
include 'footer.tpl.php';
?>