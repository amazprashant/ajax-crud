<?php
include("connect.php");
$search_value=$_POST['search'];
echo $sql_search = "SELECT * FROM student WHERE name LIKE '%{$search_value}%'OR mobile_number LIKE '%{$search_value}%'OR address LIKE '%{$search_value}%'";
$result=mysqli_query($conn,$sql_search);
$output="";
if(mysqli_num_rows($result)>0){
  $output='<table border ="1" width="100%" cellspacing="0" cellpadding="10px">
  <tr>
  <th width ="60px">Id</th>
  <th>Name</th>
  <th>Mobile</th>
  <th>Address</th>
  <th width ="90px">Edit</th>
  <th width ="90px">Delete</th>
  </tr>';
  while($row=mysqli_fetch_assoc($result)){
    $output .="<tr><td align='center'>{$row["id"]}</td>
    <td>{$row["name"]}</td>
    <td>{$row["mobile_number"]}</td>
    <td>{$row["address"]}</td>
    <td align ='center'><button class='edit-btn' data-eid='{$row["id"]}'>Edit</button></td>
    <td align='center'><button Class='delete-btn' data-id='{$row['id']}'>Delete</button></td>
    </tr>";
  }
  $output .="</table>";
  mysqli_close($conn);

  echo $output;
}else{
  echo"<h2>No Record Found</h2>";
}


?>