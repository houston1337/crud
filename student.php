<?php
session_start();
require_once "db.php";
if (isset($_GET['group_id']) && !empty($_GET['group_id']))
{
  $curr_group_id = mysqli_real_escape_string($connection ,$_GET['group_id']);
  $query = "SELECT * FROM student WHERE group_id =". $curr_group_id ." ORDER BY FIO ASC";
  $req = mysqli_query($connection,$query);
}
else {
  header("Location: index.php");
}
$title = "Студенты";
 require "header.php" ?>
<body>
  <!--Хэдэр-->
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
      <h1>Студенты группы
        <?php
        if (isset($_GET['group_id']) && !empty($_GET['group_id']))
        {
          $query_group_name= "SELECT Name FROM groups WHERE id= $curr_group_id ";
          $req_group_name = mysqli_query($connection,$query_group_name);
          $resp_group_name = mysqli_fetch_assoc($req_group_name);
          if(  $resp_group_name!= NULL)
          {
            echo $resp_group_name['Name'];
          }
          else {
            header("Location: 404.php");
          }
        }

        ?>
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
  <!--Таблица-->
  <div class="container">
    <table border="1" class="table table-striped">
      <thead>
        <tr>
          <th scope="col">ФИО </th>
          <th scope="col">Возраст</th>
          <th scope="col">Пол</th>
          <?php if(isset($_SESSION['login'])): ?>
            <th scope="col">Функции</th>
          <?php endif; ?>
        </tr>
      </thead>
      <?php if($req): ?>
        <?php while ($resp = mysqli_fetch_assoc($req)): ?>
          <tr scope="row">
            <th><?php echo $resp['FIO']; ?></th>
            <th><?php echo $resp['age']; ?></th>
            <th><?php
            if($resp['sex']==1)
            {
              echo "муж";
            }
            else
            {
              echo "жен";
            }
            ?>
          </th>
          <?php if(isset($_SESSION['login'])): ?>
            <th>
              <a href="update.php?id=<?php echo $resp['id']; ?>&group_id=<?php echo $curr_group_id; ?>" title="Редактировать" style="text-decoration: none">
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-pencil text-warning" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                  <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                </svg>
              </a>
              <a href="delete.php?id=<?php echo $resp['id']; ?>&group_id=<?php echo $curr_group_id; ?>" title="Удалить" style="text-decoration: none">
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-x-square text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                  <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                  <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                </svg>
              </a>
            </th>
          <?php endif; ?>
        </tr>
      <?php endwhile; ?>
      <tr>
        <?php if(isset($_SESSION['login'])): ?>
          <th colspan="4" scope="row">
            <a href="create.php?group_id=<?php echo $curr_group_id; ?>" class="text-success" style="text-decoration: none" title="Добавить нового студента">
              <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus-square-fill text-success" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4a.5.5 0 0 0-1 0v3.5H4a.5.5 0 0 0 0 1h3.5V12a.5.5 0 0 0 1 0V8.5H12a.5.5 0 0 0 0-1H8.5V4z"/>
              </svg>
            </a>
          <?php endif; ?>
        </th>
      </tr>
    </table>
  </div>
<?php else:?>
  <p>studeent not found</p>
<?php endif; ?>
<?php require "footer.php" ?>
</body>
</html>
