<?php include "connection.php";?>
<!DOCTYPE html>
<html>
    <head>
        <script>
        function myFunction() {
        var x = document.getElementById("pass");
        if (x.type === "password") {
        x.type = "text";
       } else {
         x.type = "password";
  }
}
        </script>
<?php
session_start();
$err1=$err2=$err3="";

if(isset($_POST['login']))
{
    echo "you such";
     $un=mysqli_real_escape_string($con,$_POST['mail']);
      $pa=mysqli_real_escape_string($con,$_POST['pass']);
      $uname=trim($un);
      $password=trim($pa);
      if(!empty($uname) && !empty($password)){	  
	  $query="SELECT * FROM Police WHERE uname='$uname' AND password='$password'";
	  $q1=mysqli_query($con,$query);
	  if(mysqli_num_rows($q1)>0){
	      while($r=mysqli_fetch_assoc($q1)){
		  $_SESSION['aname']=$uname;
		  $_SESSION['stat']=$r['Station'];
		  header("Location:i1.php");
	  }
	  }
	  else{
		  $err3="EMAIL OR PASSWORD NOT VALID";
	  }
	  }
	  else if(empty($uname) || empty($password)){
		  if(empty($uname)){
			  $err1="EMAIL CANT BE EMPTY";
		  }
		  else if(empty($password)){
			$err1="PASSWORD CANT BE EMPTY";  
		  }
		 else{
			 $err3="EMAIL ID AND PASSWORD CANT BE EMPTY";
		 }
	  }
}
?>
<style>
@import url('https://fonts.googleapis.com/css?family=Numans');

html,body{
background-image: url('pro1.jpg');
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'Numans', sans-serif;
}
.error{
    color:red;
}
.container{
height: 100%;
align-content: center;
}

.card{
height: 370px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #FFC312;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #FFC312;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #FFC312;
width: 100px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}
</style>
 <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Admin Sign In</h3>
				
			</div>
			<div class="card-body">
				<form method="post" action="index1.php">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" id="pass" name="mail" placeholder="username">
						
					</div>
					<span class="error"><?php echo $err1;?></span>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control"  name="pass"placeholder="password">
					</div>
						<span class="error"><?php echo $err2;?></span>
							<span class="error"><?php echo $err3;?></span>
					<div class="row align-items-center remember">
						<input type="checkbox" onclick="myFunction()">show password
					</div>
					<div class="form-group">
						<input type="submit" value="Login" name="login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
			      <div class="d-flex justify-content-center">
					<a href="index.php">ARE YOU USER</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>