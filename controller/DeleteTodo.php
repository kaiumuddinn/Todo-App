<?php
session_start();

$id = $_REQUEST['id'];

$query = "DELETE FROM todos WHERE id = $id";
include_once "../database/env.php";
$result = mysqli_query($conn, $query);

if($result){
    $_SESSION['success'] = "Todo deleted successfully";
    header("Location: ../AllTodo.php");
}