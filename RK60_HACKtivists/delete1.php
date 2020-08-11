<?php
include 'connection.php';
if(isset($_GET['id'])){
$id=$_GET['id'];
echo $id;

$query="DELETE FROM Police where SL_NO='$id'";
$q=mysqli_query($con,$query);
if($q){
header("LOCATION:users1.php");
}
}
?>