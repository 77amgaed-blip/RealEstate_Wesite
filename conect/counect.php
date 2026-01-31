<?php
$host="localhost";
$username="root";
$db_name="db_bs_bim";
$password="";
 $conn=mysqli_connect($host,$username,$password,$db_name);
 if(isset($conn)){
    echo " تم الاتصال بنجاح  ";
 }else{
    echo "لم يتم الاتصال بقاعدة البيانات";
 }

?>