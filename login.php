<?php
session_start();
include("database.php");
@$txtUserName = mysqli_real_escape_string($con,$_POST["uname"]);  
@$txtPassword =	mysqli_real_escape_string($con,$_POST["psw"]);

if((!empty($txtUserName)) && (!empty($txtPassword)))
{ 	
	$sql_reg = "select * from user_reg where username = '$txtUserName' and password = '$txtPassword' and status='Active'";
	$que = mysqli_query($con,"$sql_reg");
	
 	if($datarow=mysqli_fetch_array($que, MYSQLI_ASSOC))
	{  
   		$ip_chk = '1';
		$_SESSION["uid"]= $datarow['id']; ?>
        <script language="javascript">
        location.href='welcome.php';
         </script>  
  <?php  }
    else {  ?>
       <script language="javascript">
        location.href='logout.php';
         </script> 
  <?php  }
}
 ?>