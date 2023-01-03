<?php 
include("connect.php");

$student_id = $_POST['id'];
$student_name = $_POST['name'];
$student_mobile = $_POST['mobile'];
$student_address = $_POST['address'];

$sql_update = "UPDATE student SET name = '{$student_name}',mobile_number='{$student_mobile}',address='{$student_address}' WHERE id ='{$student_id}'";

if(mysqli_query($conn,$sql_update)){
    echo 1;
}else{
    echo 0;
}
?>