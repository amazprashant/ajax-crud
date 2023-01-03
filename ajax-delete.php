<?php
include("connect.php");

$student_Id = $_POST["id"];

$sql="DELETE FROM student WHERE id = {$student_Id}";
if(mysqli_query($conn,$sql)){
    echo 1;
}else{
    echo 0;
}

?>