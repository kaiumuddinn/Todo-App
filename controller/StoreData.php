<?php
session_start();

$title = $_REQUEST['title'];
$detail = $_REQUEST['detail'];
$date = empty($_REQUEST['date']) ? date('Y-m-d') : $_REQUEST['date'];
$errors = [];
$today = strtotime(date('d-m-Y'));
$selectedDate = strtotime($date);



// Title Validation
if(empty($title)){
    $errors['title_error'] = "Title is required";
} else if(strlen($title) < 3){
    $errors['title_error'] = "Title must be at least 3 characters";
} else if(strlen($title) > 200){
    $errors['title_error'] = "Title must not exceed 200 characters";
}

// Detail Validation
if(empty($detail)){
    $errors['detail_error'] = "Detail is required";
} else if(strlen($detail) < 10){
    $errors['detail_error'] = "Detail must be at least 10 characters";
} else if(strlen($detail) > 500){
    $errors['detail_error'] = "Detail must not exceed 500 characters";
}

// Date Validation
if(empty($date)){
    $selectedDate = $today;
} else if($selectedDate < $today){
    $errors['date_error'] = "The date must be today or in the future";
}


// Check if there are any errors
if(count($errors) > 0){
    $_SESSION['old_data'] = $_REQUEST;
    $_SESSION['form_errors'] = $errors;
    header("Location: ../index.php");
} else{
    // Insert data into database
    include_once "../database/env.php";
    $query = "INSERT INTO todos(title, details, data) VALUES ('$title','$detail','$date')";
    $result = mysqli_query($conn, $query);

    if($result){
        $_SESSION['success'] = "Todo added successfully";
        header("Location: ../AllTodo.php");
    } /*else{
        $_SESSION['error'] = "Failed to add todo";
        header("Location: ../index.php");
    }*/
}