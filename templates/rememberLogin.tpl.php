<?php
include 'src/templates/header.tpl.php';
?>
<main class="container">
  <form action="<?=BASE?>rememberLogaction" method="POST">
    <div class="form-group">
      <label>Username: <?php echo $_SESSION["uname"]; ?> </label><br>
      <button type="submit" class="btn btn-primary" name="rememberedUser">Log in with remembered user</button>
    </div>
    <div class="form-group">
      <label for="pass">Another user</label><br>
      <button type="submit" class="btn btn-primary" name="anotherUser">Log in with another user</button>
    </div>
  </form>
</main>
<?php
include 'src/templates/footer.tpl.php';
?>