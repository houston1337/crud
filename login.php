<?php
session_start();
//var_dump($_POST);

$login = "admin";
$pass= "admin";

if (isset($_POST['submit']))
{
  $user_login = $_POST['login'];
  $user_pass = $_POST['password'];
  if($user_login === $login && $user_pass === $pass )
  {
    echo "<p>Login success</p>";
    $_SESSION['login'] = true;
    header("Location: index.php");
  }
  else
  {
    echo "<p>Wrong login or password</p>";
  }

}
if (isset($_SESSION['login']))
{
  header("Location: index.php");
}

?>


<?php require "header.php" ?>
<title>Login</title>
</head>
<body>
  <div class="navbar navbar-light bg-light d-flex justify-content-betweenr">
    <div class="p-2">
      <a href="index.php" title="Вернуться на главную" class="text-muted" style="text-decoration: none">
        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
          <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
        </svg>
      </a>
    </div>
    <div class="p-2">
      <h1>Login</h1>
    </div>
  </div>
  <div class="container bg-light col-sm-6">
    <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-group">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Логин</label>
          <div class="col-sm-10">
            <input type="text" name="login"  placeholder="login" class="form-control" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Пароль</label>
          <div class="col-sm-10">
            <input type="password" name="password" placeholder="pass" class="form-control" required>
          </div>
        </div>
      </div>
      <div class="col-sm-10">
        <input type="submit" name="submit" value="Login" class="btn btn-success">
      </div>
    </form>
  </div>
<?php require "footer.php"; ?>
</body>
</html>
