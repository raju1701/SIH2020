<?php
include 'connection.php'; 
?>
<!DOCTYPE html>
<html>
<head>
<?php
session_start();
$nameErr=$emailErr=$passErr=$repassErr=$mobErr=$mobErr1=$mobErr2=$mobErr3=$mobErr4=$mobErr5="";
if(isset($_POST['submit'])){
	
	$user=mysqli_real_escape_string($con,$_POST['username']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$pass=mysqli_real_escape_string($con,$_POST['pass']);
	$repass=mysqli_real_escape_string($con,$_POST['repass']);
	
	$mob=$_POST['number'];
	$cont1=$_POST['cont1'];
	$cont2=$_POST['cont2'];
	$cont3=$_POST['cont3'];
	$cont4=$_POST['cont4'];
	$cont5=$_POST['cont5'];
	$gen=$_POST['gender'];
	$u1=trim($user);
	$e1=trim($email);
	$p1=trim($pass);
	$p2=trim($repass);
	$mob1=trim($mob);
	$cont11=trim($cont1);
	$cont22=trim($cont2);
	$cont33=trim($cont3);
	$cont44=trim($cont4);
	$cont55=trim($cont5);
	if(empty($e1)){
		
		$emailerr= "email id cant be empty";
		
	}
	 else if(empty($u1)){
		$nameErr="USERNAME CANT BE EMPTY";
	}
	else if(empty($p1)){
		$passErr= " password  cant be empty";
	}
	else if(empty($p2)){
		$repassErr=" password  cant be empty";
	}
	else if(empty($mob1)){
		$mobErr=" enter mobile number  cant be empty";
	}
	else if(empty($cont11)){
		$mobErr1=" enter mobile number  cant be empty";
	}
	else if(empty($cont22)){
		$mobErr2=" enter mobile number  cant be empty";
	}
	else if(empty($cont33)){
		$mobErr3=" enter mobile number  cant be empty";
	}
	else if(empty($cont44)){
		$mobErr4=" enter mobile number  cant be empty";
	}
	else if(empty($cont55)){
		$mobErr5=" enter mobile number  cant be empty";
	}
	else{
		if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$e1)) {
           $emailErr="enter a valid email address";
        } else if(!preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/',$p1)){
			$passErr="password not valid <br>
			IT SHOULD CONTAIN AT LEAST ONE CAPTITOL LETTER <br> A NUMBER AND SPEILCAL CHARACTER <br> MINIMUM LENGTH 8 ";
		}
		else if(!preg_match('/^[6-9][0-9]{9}$/', $mob1)){
			$mobErr= "Mobile number cant be value";
		}
		else if(!preg_match('/^[6-9][0-9]{9}$/', $cont11)){
			$mobErr1= "Mobile number cant be value";
		}
		else if(!preg_match('/^[6-9][0-9]{9}$/', $cont22)){
			$mobErr2= "Mobile number cant be value";
		}
		else if(!preg_match('/^[6-9][0-9]{9}$/', $cont33)){
			$mobErr3= "Mobile number cant be value";
		}
		else if(!preg_match('/^[6-9][0-9]{9}$/', $cont44)){
			$mobErr4= "Mobile number cant be value";
		}
		else if(!preg_match('/^[6-9][0-9]{9}$/', $cont55)){
			$mobErr5= "Mobile number cant be value";
		}
		 else {
			 $query="SELECT email,password FROM users WHERE email='$e1' AND password=md5('$p1')";
			 $q2=mysqli_query($con,$query);
			 if(mysqli_num_rows($q2)>0){
				 echo "email id or password already exist";
			 }
			 else if($p1!=$p2){
				 $repassErr= "password and retype password not same";
			 }
			 else{
				 $p1=md5($p1);
				 $q1="INSERT INTO users (user,email,password,mobile,gender,cont1,cont2,cont3,cont4,cont5,latitude,longitude,address,status,Role) VALUES('$u1','$e1','$p1','$mob1','$gen','$cont11','$cont22','$cont33','$cont44','$cont55','0','0',' ','0','Public')";
				 if(mysqli_query($con,$q1)){
					 $_SESSION['uname']=$e1;
					 header("Location:insert.php");
					 echo "inserted successfully";
				 }
			 }
				 
			 
		 }
	    }
	
}





?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
.error{
	color:red;
	font-size:10px;
	
}
.jumbotron{
   background-image:url("maxresdefault.jpg");
   background-size:cover;
   background-position:center;
}
form{
    margin:40px auto;
	box-shadow:5px 5px 10px 5px ;
	width:350px;
	height:85%;
	border-radius:5px;
	background:rgba(0,0,0,0.2);
}
.sign{
	font-size:20px;
	margin-top:15px;
	
	position:relative;
	color:white;
	font-weight:bold;
	
	border-radius:5px;
	
	
}
input{
	margin-top:10px;
	border-radius:2px;
	border:none;
	border-bottom:2px solid green;
	padding:5px;
	background:none;
	color:white;
}
::placeholder{
	color:white;
}
button{
	margin-top:10px;
	width:150px;
	border-radius:5px;
	border:none;
	background-color:#1e90ff;
	color:white;
	
}
input [type=text]{
	margin-top:20px;
	
}
</style>
</head>
<body>
<div class="jumbotron text-center" style=" height:150vh;">

 <form action="sign.php" method="post"  >
 <div class="sign">
 <span id="sign">SIGN UP</span>
 </div><br>
  <input type="text " id="username" name="username" placeholder="ENTER YOUR FULL NAME" Required /><br>
 <span class="error">  <?php echo $nameErr;?></span><br>
 <input type="text " id="email" name="email" placeholder="ENTER THE EMAIL" Required /><br>
 <span class="error">  <?php echo $emailErr;?></span><br>
 <input type="password" id="pass" name="pass" placeholder="PASSWORD" Required /><br>
 <span class="error">  <?php echo $passErr;?></span><br>
 <input type="password" id="repass" name="repass" placeholder="RETYPE PASSWORD"Required /><br>
 <span class="error">  <?php echo $repassErr;?></span><br>
 <input type="number" id="number" name="number" placeholder="MOBILE NUMBER"Required /><br>
 <span class="error">  <?php echo $mobErr;?></span><br>
 

 <input type="number" id="cont1" name="cont1" placeholder="CONTACT 1"Required /><br>
 <span class="error">  <?php echo $mobErr1;?></span><br>
  <input type="number" id="cont2" name="cont2" placeholder="CONTACT 2"Required /><br>
 <span class="error">  <?php echo $mobErr2;?></span><br>
  <input type="number" id="cont3" name="cont3" placeholder="CONTACT 3"Required /><br>
 <span class="error">  <?php echo $mobErr3;?></span><br>
  <input type="number" id="cont4" name="cont4" placeholder="CONTACT 4"Required /><br>
 <span class="error">  <?php echo $mobErr4;?></span><br>
  <input type="number" id="cont5" name="cont5" placeholder="CONTACT 5"Required /><br>
 <span class="error">  <?php echo $mobErr5;?></span><br>
 <input type="radio" name="gender"

value="female"> <label style="color:white;"> &nbsp   Female</label>&nbsp
<input type="radio" name="gender"

value="male" > <label style="color:white;">&nbsp     Male</label>&nbsp 
<input type="radio" name="gender"

value="other"> <label style="color:white;">&nbsp     Other</label><br>
 <button type="submit" name="submit">SIGN IN </button><BR>
 <button type="submit" name="sub1"><a href="index.php" style="text-decoration:none; color:white;">LOGIN  </button>
 </form>

 </div>
</body>
</html>