<?php session_start();
 include 'database.php';
$text = $_REQUEST['yourtext'];
$row_array = array();
$return_srray= array();
if(isset($text) && $text!="")
{
    $sql = mysqli_query($con, "INSERT INTO `text`(`text`, `user`) VALUES ('$text','".$_SESSION['uid']."')");
}

// $select= mysqli_query($con, "SELECT * FROM `text` where status='Active' order by id desc limit 0,1");
//     while($row = mysqli_fetch_array($select)){
//           $row_array['last_insert_text'] = $row['text'];
//     }

$select= mysqli_query($con, "SELECT * FROM `text` where status='Active' order by id desc");
while($row = mysqli_fetch_assoc($select)){
    $row_array["data"][] = $row;    
}
$row_array['process']='202';
//array_push($return_srray,$row_array);
 echo json_encode($row_array);

?>