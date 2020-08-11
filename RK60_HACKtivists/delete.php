<?php
include 'connection.php';
if(isset($_GET['id'])){
$id=$_GET['id'];
echo $id;

$query="UPDATE time SET status='0' where SLNO='$id'";
$q=mysqli_query($con,$query);
if($q){
header("LOCATION:i1.php");
}
}
?>