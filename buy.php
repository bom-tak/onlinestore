<?php

session_start();

if(!isset($_SESSION["username"])){
    $_SESSION["error"] = true;
    header("location:index.php");
    exit;
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $conn = mysqli_connect("localhost","root","","onlineStore");
    $sql  = "UPDATE `manage` SET `amount` = `amount` - 1 WHERE `id` = '$id' AND `amount` > 0 ;";
    $res = mysqli_query($conn,$sql);

    header("location:index.php");
}
