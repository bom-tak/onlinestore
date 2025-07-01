<?php 
/*
    in this code I will try to uplode the images in a file then represent it , but in real life be ware as there must be a moderation on this images to prevent uplode illegal photos .
*/

$conn = mysqli_connect("localhost","root","","onlineStore");


session_start();

$uploadDir = "img/";

if(!is_dir($uploadDir)){
    mkdir("img/","0755",true);
}

if(isset($_FILES['image']) && $_FILES['image'] != UPLOAD_ERR_OK){
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName    = $_FILES['image']['name'];
    $fileSize    = $_FILES['image']['size'];
    $fileType    = $_FILES['image']['type'];
    $typeError   = $sizeError = 0;


    $validType = ['image/png' , 'image/jpeg','image/jpg'];

    if(!in_array($fileType,$validType)){
        echo "upload images only , NOTE : .GIF files is invalid <br>";
        $typeError = 1;
    }
    
    if($fileSize > (3*1000*1000)){
        echo "ERROR : maximum file size is 3 MB <br>";
        $sizeError = 1;
    }

    if($typeError != 1 || $sizeError != 1){
        $exten = pathinfo($fileName,PATHINFO_EXTENSION);
        $uniqueName = uniqid() . "." . $exten;
        $destenaion = $uploadDir . $uniqueName;

        if(!move_uploaded_file($fileTmpPath,$destenaion)){
            "Error: Image upload error <br>";
        }else{
            $prName        = trim(htmlspecialchars(htmlentities($_POST['prName'])));
            $prPrice       = htmlspecialchars(htmlentities($_POST['prPrice']));
            $prAmount      = htmlspecialchars(htmlentities($_POST['prAmount']));
            $prDescription = trim(htmlspecialchars(htmlentities($_POST['prDescription'])));
            $sellerMail    = $_SESSION['mail'];
            $sellerName    = $_SESSION['username'];

            $sql = "INSERT INTO `manage` (`img`,`price`,`sellerMail`,`sellerName`,`description`,`productName`,`amount`) VALUES ('$uniqueName','$prPrice','$sellerMail','$sellerName','$prDescription','$prName','$prAmount');";

            $res = mysqli_query($conn,$sql);

            header("location:seller.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
</head>
<body>
    <h1>Hello <?php echo ucfirst($_SESSION["username"]) ?> , let's add some products.</h1>

    <form method="post" enctype="multipart/form-data" >
        <p>Enter the name of the product </p>
        <input type="text" name="prName" required> <br>
        <p>Enter the price of the product </p>
        <input type="number" name="prPrice" inputmode="numeric" step="0.01" required> <br>
        <p>Enter the amout of the product </p>
        <input type="number" name="prAmount" inputmode="numeric" required> <br>
        <p>Uploade the image of the product </p>
        <input type="file" name="image" accept="images/*" required> <br>
        <textarea name="prDescription" cols="50" rows="10" placeholder="Write the description of the product"></textarea> <br>
        <input type="submit" value="submit">
    </form>
</body>
</html>