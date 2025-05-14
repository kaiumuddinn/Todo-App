<?php
session_start();

$id = $_REQUEST['id'];
$deleteBtn = $_REQUEST['deleteAll'];

$query = "DELETE FROM todos WHERE id = $id";
include_once "../database/env.php";
$result = mysqli_query($conn, $query);

if($result){
    $_SESSION['deleted'] = "Todo deleted successfully";
    header("Location: ../AllTodo.php");
}