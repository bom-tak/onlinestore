<?php

$conn = mysqli_connect("localhost","root","","onlineStore");


if(isset($_SERVER["REQUEST_METHOD"]) == "post"){
    
    // check if email is already used    
    if(isset($_POST["email"])){
        $mail = htmlspecialchars(htmlentities($_POST['email']));

        $sql = "SELECT `email` FROM `users` WHERE `email` = '$mail';";
        $res = mysqli_query($conn,$sql);
        $ans = mysqli_fetch_all($res);

        if(count($ans) != 0){
            echo "This mail is already used , if you have an account try to <a href='login.php'>Login</a>";
        }else{
            if(isset($_POST['password']) && isset($_POST['gender']) && isset($_POST['name']) && isset($_POST['type'])){
                $pass   = sha1(trim(htmlspecialchars(htmlentities($_POST['password']))));
                $gender = htmlspecialchars(htmlentities($_POST['gender']));
                $name   = trim(htmlspecialchars(htmlentities($_POST['name'])));
                $type   = htmlspecialchars(htmlentities($_POST['type']));

                    $sql = "INSERT INTO `users`(`email`,`password`,`gender`,`username`,`type`) VALUES('$mail','$pass','$gender','$name','$type');";
                    $res = mysqli_query($conn,$sql);
                    
                    header("location:login.php");

            }

        }
    }


}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
</head>
<body>
    <h1>Hello in my store</h1>
    <form method="post">
        <input type="email" name="email" placeholder="Enter your Email" required> <br>
        <input type="password" name="password" placeholder="Enter your password" required> <br>
        <p>Select your gender</p>
        <select name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select> <br>
        <input type="text" name="name" placeholder="Enter your username" required> <br>
        <p>What do you want to do in this store</p>
        <select name="type">
            <option value="buyer">Discover and buy Items</option>
            <option value="seller">Sell some items</option>
        </select> <br>
        <input type="submit" value="signup">
    </form>

    <script>
        const password = document.querySelector(`[name = "password"]`);
        const submit = document.querySelector(`[type = "submit"]`);
        submit.onclick = function (){
            if(password.value.trim() === ""){
                alert("password field is still empty");
            }
        }
    </script>
</body>
</html>