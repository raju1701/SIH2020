<?php
include 'connection.php';?>
<!DOCTYPE HTML>
<html>
<head>
    <style>
    .card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 400px;
  margin: auto;
  text-align: center;
  border-bottom:5px solid white;
  border-top:5px solid green;
  border-left:5px solid blue;
  border-right:5px solid orange;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 50%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
  width:50%;
   background-color: #000;
}

button:hover, a:hover {
  opacity: 0.7;}
  </style>
</head>
<body>
   
    <?php
session_start();

$uname=$_SESSION['uname'];

$query="SELECT * FROM users WHERE email='$uname'";
$q1=mysqli_query($con,$query);
if(mysqli_num_rows($q1)>0){
	while($r=mysqli_fetch_assoc($q1)){
	    ?>
 <div class="card">
  <img src="photo.jpg" alt="John" style="width:95%">
		<h1>WELCOME'S<br><?php echo $r['user'];?></h1>
		
	
		<p class="title">EMAIL:&nbsp<?php echo $r['email'];?></p>
	
		
        <p>CONTACT NO:&nbsp<?php echo $r['mobile'];?></p>
         <p>ADDRESS: &nbsp <?php echo $r['address'];?></p>
          <p>GENDER: &nbsp<?php echo $r['gender'];?></p>
           
      
	<?php
	}
}
?>


  
 <div style="display:flex">
     <a href="pro.php"><button>BACK</button></a>
     <button>EDIT</button>
</div>
</div>
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>
</html>