<?php
include("connect.php");
$studentId = $_POST['id'];
$sql="SELECT * FROM student where id = {$studentId}";
$result= mysqli_query($conn,$sql) or die("SQL Query Failed");
$output="";
if(mysqli_num_rows($result)>0){
    while($row= mysqli_fetch_assoc($result)){
        $output .= "<tr>
          <td width='90px'>Name</td>
          <td><input type='text' id='edit-name' value='{$row["name"]}'>
              <input type='text' id='edit-id' hidden value='{$row["id"]}'>
          </td>
        </tr>
        <tr>
          <td>Mobile Number</td>
          <td><input type='text' id='edit-mobile' value='{$row["mobile_number"]}'></td>
        </tr>
        <tr>
          <td>Address</td>
          <td><input type='text' id='edit-address' value='{$row["address"]}'></td>
        </tr>
        <tr>
          <td></td>
          <td><input type='submit' id='edit-submit' value='save'></td>
        </tr>";    
      }   
    mysqli_close($conn);
    echo $output;
}else{
    echo"<h2>Record Not found<h2>";
}
?>