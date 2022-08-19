<?php session_start(); 
if(!isset($_SESSION['uid'])){
  echo "<script langugage='javascript'>window.location.href='logout.php';</script>";
}
include 'database.php';
function getusername($uid){
  global $con;
  $get_uid = mysqli_query($con, "SELECT username from user_reg where id='$uid'");
  $user =  mysqli_fetch_assoc($get_uid);
  $user_name = $user['username'];
  return($user_name);
}
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
  <title>JoomDev</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="form.css">
  <style>
    .container {
    width: 422px!important;
}
.btn{
    padding: 6px 4px;

}
  </style>
</head>
<body>

<div class="container">
  <h6 style="text-align:right"><?php echo getusername($_SESSION['uid']); ?> |<a href="logout.php"> Logout</a>
</h6>
  <h2 style="text-align:center">Add Text</h2>
  <form method="post" action="addtext.php" id='textform' name='textform'>
  <div class="col-md-10">
    <textarea class='form-control' placeholder="Enter Your Text" name="yourtext" id='yourtext' required></textarea>
  </div>
  <div class="col-md-2">
    <button class="btn btn-small btn-success">Go</button>
  </div>
  </form>
  
</div>
<div class="container table-responsive py-5" id='Showtext'>
</div>

<script>
    $(document).ready(function(){
    $('#textform').submit(function(e){
        e.preventDefault();
        
        var form = $(this);
        var actionUrl = form.attr('action');
        
        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(),
            success:function(data){
                response = $.parseJSON(data);
               
                manager_data();
                           
            }
        });
    });
});

function manager_data()
{
  $.ajax({
            type: "Get",
            url: "addtext.php",
            data: {"yourtext":""},
            success:function(data){
                response = $.parseJSON(data);
                console.log(response);
                if(response.process=='202'){
                    
                    $("#yourtext").val("");
                  
                    var html =""; var sno=1;
                      html += "<table style='width: 100%;' class='table table-bordered table-hover'>";
                      html += "<tr>";
                      html += "<th>Sno</th>";
                      html += "<th>TEXT</th>";
                      html += "</tr>";

                    $.each(response.data,function(i, item){
                     
                    
                      html += "<tr>";
                      html += "<td>"+sno+"</td>";
                      html += "<td>"+item.text+"</td>";
                      html += "</tr>";
                     
                      sno++;
                    });
                    html += "</table>";
                    $("#Showtext").html(html);
                }
                
                    
              
            }
        });
}
manager_data();
</script>
</body>
</html>
