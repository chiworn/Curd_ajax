<?php 
include "Connection.php";
global $con;
    $id = $_POST['id'];
    $now = date("Y-m-d_H-i-s");
    $delete = " UPDATE `tb_ajax` SET `status`= 0 ,`update_at`='$now'WHERE `id` = '$id' " ;
    $con ->query($delete);
    echo 1;
?> 