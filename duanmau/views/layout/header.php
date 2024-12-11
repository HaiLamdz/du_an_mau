<?php 
// var_dump($_SESSION);
// var_dump($_SESSION['id']);die;
    if(isset($_SESSION['user'])){
        $user_id = $_SESSION['user']['id'];
        // var_dump($user_id);die;
    }else{
      header("location: " . BASE_URL);
      exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Clothing Store</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./assets/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="./assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="./assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="./assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<style>
    .card-body{
        position: relative;
        overflow: hidden;
    }
    .card-body>.detail {
        text-transform: uppercase;
        text-decoration: none;
        text-align: center;
        display: block;
        background-color: #446084;
        color: #fff;
        padding: 10px 0px;
        position: absolute;
        bottom: -36px;
        min-width: 100%;
        transition: 0.25s ease-in-out;
        opacity: 0.85;
    }
    .card:hover .card-body a.detail {
        bottom: -5px;
    }
</style>

<body>
    <!-- <header class="bg-dark text-white text-center py-3">
        <h1 >HẢI LAM STORE</h1>
        <h6>Khách Hàng Là Thượng Đế <i class="fa-solid fa-crown"></i></h6>
    </header> -->