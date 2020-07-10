<?php
session_start();
//var_dump($_POST);

if (!isset($_SESSION['login']))
{
  header("Location: 404.php");
}
else {
  if (isset($_GET['id']) && !empty($_GET['id']))
  {
    require_once "db.php";
    $id = mysqli_real_escape_string($connection ,$_GET['id']);
    $group_id = mysqli_real_escape_string($connection ,$_GET['group_id']);
    $query = "DELETE FROM student WHERE id =" . $id;

    if ( mysqli_query($connection, $query))
    {
      header("Location: student.php?group_id=$group_id");
    }
    else
    {
      die("ERROR. NOT DELETED");
    }
  }
}


?>
