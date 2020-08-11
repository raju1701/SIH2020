<?php include 'connection.php';
session_start();


?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>
      
<nav class="navbar navbar-inverse navbar-fixed-top" style="background:white;">
  <div class="container-fluid">
    <div class="navbar-header" >
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="background:black;">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <img class="navbar-brand" src="photo.jpg"  style="width:70px; height:70px;"></img>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar"  style="background:black;">
      <ul class="nav navbar-nav" style="background:black;">
        <li class="active"><a href="i1">Home</a></li>
        <li style="background:black;"><a href="users.php" style="color:white;" >USERS</a></li>
        <li style="background:black;"><a href="c1.php" style="color:white;">CREATE USER</a></li>
      <li style="background:black;"><a href="sample1.php" style="color:white;">ENTER COMPLAINTS</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="" style="background:black;"><span class="glyphicon glyphicon-user" style="color:white;"></span> PROFILE</a></li>
        <li><a href="log.php" style="background:black;"><span class="glyphicon glyphicon-log-in"style="color:white;"></span> LOGOUT</a></li>
      </ul>
    </div>
  </div>
</nav>
  <div class="container" style="margin-top:70px;">
                                                                                      
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>SL.NO</th>
        <th>IMAGE</th>
        <th>LOCATION</th>
        <th>DATE</th>
		<th>time</th>
		<th>nearest station</th>
		<th>EMERGENCY</th>
		<th>status</th>
        
      </tr>
    </thead>
<tbody>
<?php
$stat=$_SESSION['stat'];

$d=date("Y-m-d");
$query="SELECT * FROM time where status='1' AND date='$d' ORDER BY time DESC";
$q=mysqli_query($con,$query);
if(mysqli_num_rows($q)>0){
while($r=mysqli_fetch_assoc($q)){
	$img="images/".$r['image'];
	?>

<tr>
	<?php
echo "<td>".$r['SLNO']."</td>";	
echo "<td><img src='".$img."' alt='cant display'  style='height:100px; width:100px;'/></td>";
echo "<td>".$r['location']."</td>";
echo "<td>".$r['date']."</td>";
echo "<td>".$r['time']."</td>";
echo "<td>".$r['nearstat']."</td>";
echo "<td>".$r['comment']."</td>";
echo "<td><a href='delete.php?id=".$r['SLNO']."'><button type='submit'>done</button></a></td>";
?></tr>
<?php

}

}

/*else{
    $query1="SELECT * FROM time where status='1' AND date='.$d.'  ORDER BY date DESC";
$q11=mysqli_query($con,$query1);
if(mysqli_num_rows($q11)>0){
while($r=mysqli_fetch_assoc($q11)){
	$img="images/".$r['image'];
	?>

<tr>
	<?php
echo "<td>".$r['SLNO']."</td>";	
echo "<td><img src='".$img."' alt='cant display'  style='height:100px; width:100px;'/></td>";
echo "<td>".$r['location']."</td>";
echo "<td>".$r['date']."</td>";
echo "<td>".$r['time']."</td>";
echo "<td>".$r['nearstat']."</td>";
echo "<td>".$r['comment']."</td>";
echo "<td><a href='delete.php?id=".$r['SLNO']."'><button type='submit'>done</button></a></td>";
?></tr>
<?php

}  
}
}*/
?>

</tbody>
</table>
</div>
</div>
<body>
</html>