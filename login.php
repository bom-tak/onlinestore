<?php

session_start();

$conn = mysqli_connect("localhost","root","","onlineStore");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $mail = trim(htmlspecialchars(htmlentities($_POST["mail"])));
    $password = sha1(htmlspecialchars(htmlentities($_POST["password"])));
    
    if(isset($mail) && isset($password)){
    
    $sql = "SELECT `email` FROM `users` WHERE `email` = '$mail' ";
    $res = mysqli_query($conn,$sql);
    $ans = mysqli_fetch_all($res);

    if(count($ans) == 1){
        $sql = "SELECT `password` FROM `users` WHERE `email` = '$mail' ";
        $res = mysqli_query($conn,$sql);
        $ans = mysqli_fetch_all($res);

        if($ans[0][0] != $password ){
            echo "email or password is wrong";
        }else{
            $sql = "SELECT `username` FROM `users` WHERE `email` = '$mail' ";
            $res = mysqli_query($conn,$sql);
            $ans = mysqli_fetch_all($res);
            
            $_SESSION["username"] = $ans[0][0];
            $_SESSION["mail"] = $mail;

            $sql = "SELECT `type` FROM `users` WHERE `email` = '$mail' ";
            $res = mysqli_query($conn,$sql);
            $ans = mysqli_fetch_all($res);

            $_SESSION["type"] = $ans[0][0];
            
            $sql = "SELECT `type` FROM `users` WHERE `email` = '$mail' ";
            $res = mysqli_query($conn,$sql);
            $ans = mysqli_fetch_all($res);

            if($ans[0][0] == "seller"){
                header("location:seller.php");
            }else{
                header("location:index.php");
            }
            
        }

    }else{
        echo "email or password is wrong";
    }

    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in page</title>
</head>
<body>
    <h1>Login page</h1>
    <form method="post">
        <p>Enter your email</p>
        <input type="email" name="mail" required> <br>
        <p>Enter your password</p>
        <input type="password" name = "password" required> <br>
        <input type="submit" value="submit">
    </form>

    <p>don't have an account ? <a href="signup.php">Signup</a></p>
</body>
</html>