<?php include 'connection.php';
session_start();
$u=$_SESSION['aname'];
$q="SELECT * FROM Police where uname='$u'";
$qq=mysqli_query($con,$q);
if(mysqli_num_rows($qq)>0){
while($r=mysqli_fetch_assoc($qq)){
if($r['Role']=='admin'){
header("LOCATION:c2.php");
}
else{
header("LOCATION:i1.php");
}
}
}
?>
