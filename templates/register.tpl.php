<?php
include 'header.tpl.php';
?>
<main class="container">
  <form action="<?=BASE?>register/reg" method="POST">
    <div class="form-group">
      <label for="uname">Username</label>
      <input type="text" class="form-control" name="uname" id="uname" aria-describedby="unameHelp" placeholder="Enter username" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="pass">Password</label>
      <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" required>
    </div>
    <div class="form-check">
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
  </form>
</main>
<?php
include 'footer.tpl.php';
?>