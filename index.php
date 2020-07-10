<?php
session_start();
require_once "db.php";

$query = "SELECT * FROM groups";
$req = mysqli_query($connection,$query);
$query_quantity_student = "SELECT COUNT(*) FROM student WHERE group_id=";

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <title>Группы</title>
</head>
<body>

  <div class="navbar navbar-light bg-light">

    <h1 class="p-2">Группы</h1>
    <?php if(isset($_SESSION['login'])): ?>
      <a href="logout.php" class="p-2">Logout</a>
    <?php else: ?>
      <a href="login.php" class="p-2">Login</a>
    <?php endif; ?>
  </div>
  <div class="container">
    <table border="1" class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Название</th>
          <th scope="col">Кол-во студентов</th>
          <?php if(isset($_SESSION['login'])): ?>
            <th scope="col">Функции</th>
          <?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php if($req): ?>
          <?php while ($resp = mysqli_fetch_assoc($req)): ?>
            <tr>
              <th scope="row">
                <a href="student.php?group_id=<?php echo $resp['id']; ?>" title="Перейти к  списку студентов группы <?php echo $resp['Name']; ?>" class="text-dark"><?php echo $resp['Name']; ?></a>
              </th>
              <th>
                <?php
                $req_quantity_student = mysqli_query($connection,$query_quantity_student . $resp['id'] );
                $resp_quantity_student = mysqli_fetch_assoc($req_quantity_student);
                echo $resp_quantity_student['COUNT(*)'];
                ?>
              </th>
              <?php if(isset($_SESSION['login'])): ?>
                <th>
                  <!--Редактировать-->
                  <a href="edit_group.php?id=<?php echo $resp['id'];?>" title="Редактировать" style="text-decoration: none">
                    <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-pencil text-warning" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                      <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                    </svg>
                  </a>
                  <!--Удалить-->
                  <a href="delete_group.php?id=<?php echo $resp['id'];?>" title="Удалить" style="text-decoration: none">
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
                <!--Добавить-->
                <a href="create_group.php" title="Добавить группу" class="text-success" style="text-decoration: none">
                  <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus-square-fill text-success" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4a.5.5 0 0 0-1 0v3.5H4a.5.5 0 0 0 0 1h3.5V12a.5.5 0 0 0 1 0V8.5H12a.5.5 0 0 0 0-1H8.5V4z"/>
                  </svg>
                  Добавить
                </a>
              <?php endif; ?>
            </th>
          </tr>
        </table>
      </div>
    <?php else:?>
      <p>Groups not found</p>
    <?php endif; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

  </body>
  </html>
