<?php 
        date_default_timezone_set('Asia/Phnom_Penh');
        $image = date('y-m-d_H-i-s').'_'.$_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $path ='../uploads/'.$image;
        move_uploaded_file($tmp_name,$path);
        echo $image;
?>