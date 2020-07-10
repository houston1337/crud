<?php
session_start();
//var_dump($_POST);

if (!isset($_SESSION['login']))
{
  header("Location: 404.php");
}

require_once "db.php";

if (isset($_GET['id']) && !empty($_GET['id']))
{
  $curr_id = mysqli_real_escape_string($connection ,$_GET['id']);
  $group_id = mysqli_real_escape_string($connection ,$_GET['group_id']);

  $query = "SELECT * FROM student WHERE id =". $curr_id;
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
  $fio= $_POST['FIO'];
  $age = $_POST['age'];
  $sex = $_POST['sex'];
  $query = "UPDATE student SET" . " ";
  $query .= "FIO = '{$fio}', ";
  $query .= "age = {$age}, ";
  $query .= "sex = {$sex}";
  $query .= " ". "WHERE id=" . $id;

  if ( mysqli_query($connection, $query))
  {
    header("Location: student.php?group_id=$group_id");
  }
  else
  {
    die("ERROR. NOT CHANGED");
  }
}

?>

<?php require "header.php" ?>
<title>Изменить данные студента</title>
</head>
<body>


  <div class="navbar navbar-light bg-light d-flex justify-content-betweenr">

    <div class="p-2">
      <a href="student.php?group_id=<?php echo $group_id; ?>" style="text-decoration: none" class="text-muted" title="Вернуться к списку студентов">
        <svg width="2em" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M7.854 4.646a.5.5 0 0 1 0 .708L5.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z"/>
          <path fill-rule="evenodd" d="M4.5 8a.5.5 0 0 1 .5-.5h6.5a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
        </svg>
        <a href="index.php" title="Вернуться на главную" class="text-muted " style="text-decoration: none">
          <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
          </svg>
        </a>
      </div>

      <h2 class="p-2">
        Изменить информацию о студенте
      </h2>
      <div class="p-2">
        <?php if(isset($_SESSION['login'])): ?>
          <a href="logout.php">Logout</a>
        <?php else: ?>
          <a href="login.php">Login</a>
        <?php endif; ?>
      </h1>
    </div>
  </div>
  <!--Форма-->
  <div class="container bg-light col-sm-6">
    <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo isset($req_data) ? $req_data['id'] : "" ?>&group_id=<?php echo $group_id; ?> " method="post">
      <div class="form-group">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">ФИО </label>
          <div class="col-sm-10">
            <input
            type="text"
            name="FIO"
            value="<?php echo isset($req_data) ? $req_data['FIO'] : "" ?>" required class="form-control">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Возраст </label>
          <div class="col-sm-10">
            <input
            type="number"
            name="age"
            value="<?php echo isset($req_data) ? $req_data['age'] : "" ?>" min="16" max="40" required class="form-control">
          </div>
        </div>

        <div class="col-sm-10">
          <fieldset class="form-group">
            <div class="row">
              <legend class="col-form-label col-sm-2 pt-0">Пол: </legend>

              <div class="col-sm-10">
                <div class="form-check">
                  <input type="radio"
                  name="sex"
                  value="1"
                  <?php  if (isset($req_data))
                  {
                    if ($req_data['sex'] == 1)
                    {
                      echo "checked = ". "true";
                    }
                  }
                  ?>
                  required>
                  <label class="form-check-label">
                    муж
                  </label>
                </div>

                <div class="form-check">
                  <input type="radio" name="sex"
                  value= "0"
                  <?php  if (isset($req_data))
                  {
                    if ($req_data['sex'] == 0)
                    {
                      echo "checked = ". "true";
                    }

                  }
                  ?>

                  required>
                  <label class="form-check-label">
                    жен
                  </label>
                </div>
              </div>

            </div>
          </fieldset>
        </div>
      </div>
      <div class="col-sm-10">
        <input type="submit" name="submit" value="Обновить" class="btn btn-success">
      </div>
    </form>
  </div>
  <?php require "footer.php" ?>
</body>
</html>
