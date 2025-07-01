<?php 
$conn = mysqli_connect("localhost","root","","onlineStore");

$id = $_GET['id'];

$sql = "DELETE FROM `manage` WHERE `id` = $id;";
$res = mysqli_query($conn,$sql);

header("location:seller.php");