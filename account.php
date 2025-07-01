<?php 
    session_start();

    $conn = mysqli_connect("localhost","root","","onlineStore");

    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }else{
        $username = ucfirst($_SESSION['username']);

        $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
        $res = mysqli_query($conn,$sql);
        $infoAssoc = mysqli_fetch_assoc($res);
        $infoKeys = array_keys($infoAssoc);
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Info</title>
</head>
<body>
    <h1>Hello <?php echo $username ?></h1>

    <?php 
        echo $username . " info: <br>";

        for($i = 1;$i < count($infoKeys);$i++){
            if($infoKeys[$i] == "password"){
                continue ;
            }
            echo ucfirst($infoKeys[$i]) . " : " . $infoAssoc[$infoKeys[$i]] . "<br>";
        }
    ?> 

    <a href="logout.php"><button>Log out</button></a>
    <br>
    <br>
    <a href="index.php"><button>Home Page</button></a>
</body>
</html>