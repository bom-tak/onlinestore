<?php 

session_start();

$conn = mysqli_connect("localhost","root","","onlineStore");

$sql = "SELECT * FROM `manage` ;";
$res = mysqli_query($conn,$sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>
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
    <?php if(!isset($_SESSION["username"])):?>
        <p>
            you are did not log in, <a href="login.php">Login</a>
        </p>
    <?php elseif($_SESSION["type"] == "seller"): ?>
            <a href="seller.php"><button>Dashboard</button></a><br><br>
    <?php elseif($_SESSION["type"] == "buyer"):?>
            <a href="account.php"><button>Your Account</button></a><br><br>
    <?php endif;?>
    <table>
        <tr>
            <td>product name</td>
            <td>image</td>
            <td>price</td>
            <td>amount</td>
            <td>seller's name</td>
            <td>seller's mail</td>
            <td>description</td>
            <td>options</td>
        </tr>
        <?php while($arr = mysqli_fetch_assoc($res)): ?>
            <tr>
                <?php
                    if($arr['amount'] == 0){
                        continue;  
                    }
                ?>

                <td><?php echo $arr['productName']?></td>
                <td>
                    <a href="img/<?php echo $arr["img"]?>" target="_blank">
                        <img src="img/<?php echo $arr["img"]?>" alt="<?php echo $arr['description']?>" title="<?php echo $arr['productName']?>">
                    </a>
                </td>
                <td><?php echo $arr['price']?>$</td>
                <td><?php echo $arr['amount']?></td>
                <td><?php echo $arr['sellerName']?></td>
                <td><?php echo $arr['sellerMail']?></td>
                <td><?php echo $arr['description']?></td>
                <td><a href="buy.php?id=<?php echo $arr['id'] ?>"><button>Buy</button></a></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>