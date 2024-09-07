<?php
include('config.php');

if(isset($_POST['upload'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image'];
    $image_location = $_FILES['image']['tmp_name'];
    $image_name     = $_FILES['image']['name'];
    $image_up       ="images/".$image_name ;
    $insert = "INSERT INTO `prod`(name, price, image) VALUES ('$name','$price','$image_up')";

    mysqli_query($conn, $insert);

    if (move_uploaded_file($image_location,$image_up)){
        echo '<script>alert("Upload success")</script>';
    }else{
        echo '<script>alert("Upload faild")</script>';
    }
    header('location: index.php');

}


?>