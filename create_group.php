<?php
session_start();
//var_dump($_POST);

if (!isset($_SESSION['login']))
{
  header("Location: 404.php");
}

require_once "db.php";
if (isset($_POST['submit']))
{
  $Name= $_POST['Name'];
  $query = "INSERT INTO groups(Name)" . " ";
  $query .= "VALUES (";
  $query .= "'{$Name}')";
  if ( mysqli_query($connection, $query))
  {
    header("Location: index.php");
  }
  else
  {
    die("ERROR. NOT CREATED");
  }
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <title>Добавить группу</title>
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
      <h1>Добавить группу
      </div>
      <div class="p-2">

        <?php if(isset($_SESSION['login'])): ?>
          <a href="logout.php">Logout</a>
        <?php else: ?>
          <a href="login.php">Login</a>
        <?php endif; ?>
      </h1>
    </div>
  </div>

  <div class="container bg-light col-sm-6">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-group">
        <div class="form-group row align-items-center">
          <label class="col-sm-2 col-form-label">Название группы</label>
          <div class="col-sm-10">
            <input type="text" name="Name" value="" required class="form-control">
          </div>
        </div>
      </div>
      <div class="col-sm-10">
        <input type="submit" name="submit" value="Создать" class="btn btn-success">
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
