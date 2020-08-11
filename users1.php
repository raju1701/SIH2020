<?php include 'connection.php';?>
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
        <li class="active"><a href="i1.php">Home</a></li>
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
        <th>USERNAME</th>
       
        <th>ROLE</th>
		<th>STATION</th>
		<th>REMOVE</th>
      </tr>
    </thead>
<tbody>
<?php

$query="SELECT * FROM Police ";
$q=mysqli_query($con,$query);
if(mysqli_num_rows($q)>0){
while($r=mysqli_fetch_assoc($q)){
    $row=strtolower($r['Role']);
if($row!="admin")
{
	?>

<tr>
	<?php
echo "<td>".$r['SL_NO']."</td>";	
echo "<td>".$r['uname']."</td>";

echo "<td>".$r['Role']."</td>";
echo "<td>".$r['Station']."</td>";
echo "<td><a href='delete1.php?id=".$r['SL_NO']."'><button type='submit'>DELETE</button></a></td>";
?></tr>
<?php
}
}

}
?>

</tbody>
</table>
</div>
</div>
<body>
</html>