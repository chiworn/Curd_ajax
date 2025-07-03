<?php
    try{
        $con =new mysqli('localhost','root','','db_ajax_curd');
    }
    catch(Exception $e){
        echo "connection faild".$e;
    }
?>  