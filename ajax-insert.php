<?php 
include("connect.php");

$student_name = $_POST["student_name"];
$student_mobile =$_POST["student_mobile"];
$student_address = $_POST["student_address"];

$sql ="INSERT INTO student(name,mobile_number,address) VALUES ('{$student_name}','{$student_mobile}','{$student_address}')";
 if(mysqli_query($conn,$sql)){
    echo 1;
 }else{
    echo 0;
 }

?>