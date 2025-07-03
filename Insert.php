<?php
    include "Connection.php";
    global $con;
    $name = $_POST['name'];
    $price = $_POST['price']; 
    $time = $_POST['time']; 
    $session = $_POST['session'];
    $image = $_POST['image']; 
    $insert = " INSERT INTO `tb_ajax`( `Cours_name`, `price`, `Time`, `Session`, `image`)
     VALUES ('$name ','$price','$time','$session ','$image')";
     $con ->query($insert);
     $select_id = "SELECT `id` FROM `tb_ajax` ORDER BY `id` DESC LIMIT 1";
     $id = $con->query($select_id);
     $id = $id->fetch_assoc()['id'];
     echo"$id";
?>