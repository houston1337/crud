<?php
session_start();


if (!isset($_SESSION['login']))
{
  header("Location: 404.php");
}

require_once "db.php";

if (isset($_GET['id']) && !empty($_GET['id']))
{
  $curr_id = mysqli_real_escape_string($connection ,$_GET['id']);
  $query = "SELECT * FROM groups WHERE id =". $curr_id;
  $req = mysqli_query($connection,$query);
  $req_data = mysqli_fetch_assoc($req);
  if(!empty($req_data))
  {

  }
  else
  {
    header("Location: 404.php");
  }

}


if (isset($_POST['submit'])) {
  $id = mysqli_real_escape_string($connection ,$_GET['id']);
  $Name= mysqli_real_escape_string($connection ,$_POST['Name']);
  $query = "UPDATE groups SET" . " ";
  $query .= "Name = '{$Name}'";
  $query .= " ". "WHERE id=" . $id;
  echo $query;
  if ( mysqli_query($connection, $query))
  {
    header("Location: index.php");
  }
  else
  {
    die("ERROR. NOT CHANGED");
  }
}
$title = "Изменить данные группы";
require "header.php"; ?>
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
    <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo isset($req_data) ? $req_data['id'] : "" ?>" method="post">
      <div class="form-group row align-items-center">
        <label class="col-sm-2 col-form-label">Название группы</label>
        <div class="col-sm-10">
          <input
          type="text"
          name="Name"
          value="<?php echo isset($req_data) ? $req_data['Name'] : "" ?>" required class="form-control">
        </div>
      </div>
      <div class="col-sm-10">
        <input type="submit" name="submit" value="Обновить" class="btn btn-success">
      </div>
    </form>
  </div>
</form>
<?php require "footer.php" ?>
</body>
</html>
