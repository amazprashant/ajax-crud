<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connect.php");

?>
<html>
    <head>
        <title>
            Crud
        </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <table border="1" width="100%" cellspacing="0" cellpadding="10px">
        <tr>
            <td>
                <div id="search-bar">
                    <label>Search :</label>
                    <input type="text" id ="search" autocomplete="off">
                </div>
            </td>
        </tr> 
        <tr>
            <td id ="table -form">
            <form id="addForm">
                <h3>Name</h3>
                <input type="text" name="name" id="name" value=""><br>
                <h3>Mobile Number</h3>
                <input type="text" name="mobile_number" id="mobile_number" value=""><br> 
                <h3>Address</h3>
                <input type="text" name="address" id="address" value=""><br>
                <input type="submit" name="submit" id ="save-button" value="Save"> 
            </form>
            </td>
         </tr>
            <tr>
                <td id="table-data">
                </td>
            </td>
        </tr>
        </table>
        <div id="modal">
            <div id="modal-form">
            <h2>Edit Form</h2>
            <table cellpadding="10px" width="100%">
            </table>
            <div id="close-btn">X</div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                function loadTable(){
            $.ajax({
                        url:"ajax-load.php",
                        type:"POST",
                        success:function(data){
                            $("#table-data").html(data);
                        } 
                    });
                }
                loadTable();
                $("#save-button").on("click", function(e){
                    e.preventDefault();
                    var name=$("#name").val();
                    var mobile=$("#mobile_number").val();
                    var address = $("#address").val();
                    //alert(name);
                    $.ajax({
                        url:"ajax-insert.php",
                        type:"POST",
                        data:{student_name:name, student_mobile:mobile, student_address:address},
                        success: function(data){
                            if(data == 1){
                               // alert("table load");
                                loadTable();
                                $("#addForm").trigger("reset");
                            }else{
                                alert("Can't save record");
                            }
                        }
                    });
                });
                $(document).on("click",".delete-btn",function(){
                    if(confirm("Do you really want to delete this record ?")){
                    var studentId= $(this).data("id");
                    var element = this;
                    //alert(element);
                    $.ajax({
                        url:"ajax-delete.php",
                        type:"POST",
                        data:{id : studentId},
                        success:function(data){
                            if(data == 1){
                                $(element).closest("tr").fadeOut();
                                
                            }else{
                                  alert("record not deleted");  
                            }
                        }
                    });
                }
                });

                $(document).on("click",".edit-btn",function(){
                    $("#modal").show();
                    var studentId=$(this).data("eid");
                    $.ajax({
                        url:"load_update_ajax.php",
                        type:"POST",
                        data:{id: studentId},
                        success:function(data){
                            $("#modal-form table").html(data);
                        }
                    });
                });
                    //Hide Modal Box
                $("#close-btn").on("click",function(){
                $("#modal").hide();
                });

                $(document).on("click","#edit-submit",function(){
                    var stu_id =$("#edit-id").val();
                    var stu_name =$("#edit-name").val();
                    var stu_mobile =$("#edit-mobile").val();
                    var stu_address =$("#edit-address").val();
                    //alert(stu_name);
                    $.ajax({
                        url:"ajax_update_form.php",
                        type:"POST",
                        data:{id:stu_id, name:stu_name, mobile:stu_mobile, address:stu_address},
                        success:function(data){
                            if(data == 1){
                            $("#modal").hide();
                            loadTable();
                            }
                        }    
                    });
                });
                $("#search").on("keyup",function(){
                    var search_term = $(this).val();
                    //alert("sadsda");
                    $.ajax({
                        url:"ajax-live-search.php",
                        type:"POST",
                        data:{search:search_term},
                        success: function(data){
                            
                            $("#table-data").html(data);
                            
                        }
                    });
                });
                
            });
               
            
            
        </script>

    </body>
</html>