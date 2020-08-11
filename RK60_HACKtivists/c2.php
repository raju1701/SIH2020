<?PHP 
include 'connection.php';
session_start(); ?>
<!DOCTYPE html>
<html>
 <head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <?php
  if(isset($_POST['submit'])){
     
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$pass=mysqli_real_escape_string($con,$_POST['pwd']);
	$repass=mysqli_real_escape_string($con,$_POST['pwd1']);
	$gen=$_POST['stat'];
	$rol=$_POST['role'];
	echo $gen;
	echo $rol;
	$email=trim($email);
	$pass=trim($pass);
	$repass=trim($repass);
	
	if(empty($email)){
		
		$err3= "email id cant be empty";
		
	}
	 else if(empty($pass)){
		$err3="USERNAME CANT BE EMPTY";
	}
	else if(empty($repass)){
		$err3 " password  cant be empty";
	}
	
	else{
	    $query="insert into Police(uname,password,Role,Station) values('$email','$pass','$rol','$gen')";
	    if(mysqli_query($con,$query)){
	        $err3="INSERTED SUCCESSFULLY";
	        
	    }
	    else{
	        echo "couldnt insert".mysqli_error($con);
	    }
	}

  }
  if(isset($_POST['rm'])){
      header("LOCATION:users1.php");
  }
  ?>
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
<div class="container" style="margin-top:50px;">
  <h2>CREATE USER</h2>
  <form method="post" action="c2.php">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
    <div class="form-group">
      <label for="pwd1">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Retype password" name="pwd1">
    </div>
    <div class="form-group">
        
      <label for="stat">SELECT THE STATION</label>
      <select name="stat">
      <option value=" "></option>
      <option value="ATTIBELE">ATTIBELE</option>
      <option value="SARJAPURA">SARJAPURA</option>
       <option value="ANEKAL">ANEKAL</option>
       </select>
    </div>
    <div class="form-group">
        
      <label for="role">SELECT THE ROLE</label>
      <select name="role">
     
      <option value="USER">USER</option>
      <option value="USER">ADMIN</option>
       
       </select>
    </div>
    <span class="error" style="color:red"><?php echo $err3;?></span>
    <button type="submit" class="btn btn-success" name="submit">Submit</button>
     <button type="submit" class="btn btn-success" name="rm">REMOVE USER</button>
  </form>
</div>
</body>
</html>