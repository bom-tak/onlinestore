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

    $mail = $_SESSION["mail"];

    $sql = "SELECT * FROM `manage` WHERE `sellerMail` = '$mail' ; ";
    $res = mysqli_query($conn,$sql);
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <style>
        img{
            display: flex;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        table,tr,td{
            border: 1px solid black;
            text-align: center;
        }
    </style>
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

    <br>

    <a href="logout.php"><button class="logOut">Log out</button></a>

    <br>
    <br>

    <table>
        <tr>
            <td>Product Name</td>
            <td>Image</td>
            <td>Price</td>
            <td>Description</td>
            <td>Amount</td>
            <td>options</td>
        </tr>
        <?php while($ans = mysqli_fetch_assoc($res)): ?>
            <tr>
                <td><?php echo $ans["productName"]?></td>
                <td>
                    <a href="img/<?php echo $ans["img"]?>" target="_blank">
                        <img src="img/<?php echo $ans["img"]?>">
                    </a>
                </td>
                <td><?php echo $ans["price"]?>$</td>
                <td><?php echo $ans["description"]?></td>
                <td><?php echo $ans["amount"]?></td>
                <td>
                    <a href="delete.php?id=<?php echo $ans["id"]?>" style="color:red">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    
    <a href="add.php"><button>Add product</button></a>
    <br>
    <br>
    <a href="index.php"><button>Home Page</button></a>
</body>
</html>