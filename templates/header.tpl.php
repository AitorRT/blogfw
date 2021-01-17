<!DOCTYPE html>
<html lang="en">

<head>
  <title>App</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/css/style.css" type="text/css">
</head>

<body>
  <header>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?=BASE?>index"><?php echo $username;?></a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="<?=BASE?>index">Home</a></li>
          <?php
          if (isset($_SESSION['uname'])) {
            echo "<li><a href='".BASE."dashboard'>Dashboard</a></li>";
            echo "<li><a href='".BASE."posts'>Posts</a></li>";
          }
          ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
          if (isset($_SESSION['uname']) || isset($_SESSION['remember'])) {
            echo "<li><a href='".BASE."logout/out'><span class='glyphicon glyphicon-user'></span> Logout</a></li>";
          } else {
            echo "<li><a href='".BASE."register/reg'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
                  <li><a href='".BASE."login/log'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
          }
          ?>
        </ul>
      </div>
    </nav>
  </header>