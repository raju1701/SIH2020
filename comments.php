<?php
include 'connection.php';
$cases=$_POST['number'];
$address=$_POST['searchbox'];
$comments=$_POST['text'];
$lat=$_POST['hidden1'];
$log=$_POST['hidden2'];
echo $address;
echo $comments;
echo $lat;
echo $log;

$query="INSERT INTO latlang(latitude,longitude,address,comments,cases) VALUES('$lat','$log','$address','$comments','$cases')";
if(mysqli_query($con,$query)){
	echo"<script> alert('thank you for taking responsiblity')";
	header("Location:i1.php");
}
else{
	echo "error".$query."<br>".mysqli_error($con);
	
}
?>