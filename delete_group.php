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
    $query = "DELETE FROM groups WHERE id =" . $id;
    $query_student = "DELETE FROM student WHERE group_id =" . $id;
    if ( mysqli_query($connection, $query) && mysqli_query($connection, $query_student))
    {
      header("Location: index.php");
    }
    else
    {
      die("ERROR. NOT DELETED");
    }
  }
}


?>
