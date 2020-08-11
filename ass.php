<?php
include 'connection.php';?>
<!DOCTYPE html>

<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
session_start();
 
 $lat=$_SESSION['lat'];
 $log=$_SESSION['log']; 
 $loc1=$_SESSION['locality'];
 


	
	$d=date("Y-m-d");
	$t=date("Y-m-d h:m:s");
	$comment=$_POST['t'];
	$title=$_POST['drop'];
	$im=$_FILES['file']['name'];
	$extt=@end(explode('.',$im));
	$fileext=strtolower($extt);
	$file=time().".".$extt;
	$loc="images/".$file;
	$ext=pathinfo($loc,PATHINFO_EXTENSION);
	$ext=strtolower($ext);
	$msg="http://maps.google.com/maps/?q=".$lat.",".$log;
	$msg1=$comment;
	$msg2=$msg."       ".$msg1."<br>".$loc;
	$arr=array("jpg","JPG","JPEG","jpeg","PNG","png");
	if(in_array($ext,$arr)){
		compressedimage($_FILES['file']['tmp_name'],$loc,60);
	    $sql="INSERT INTO time(latitude,longitude,nearstat,comment,date,time,image,location,status) VALUES('$lat','$log','$title','$comment','$d','$t','$file','$loc1','1')";
	   if(mysqli_query($con,$sql)){
$apiKey = urlencode('/aU0qFL+VdM-JcdyGgo5jpOIpj0KO8uRL02bSRTUc ');
	
	// Message details
	$numbers = array(918310085985);
	$sender = urlencode('TXTLCL');
	$message = rawurlencode($msg2);
 
	$numbers = implode(',', $numbers);
 
	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	echo $response;
       ?>
	   <div class="alert alert-info">
       <strong>THANK YOU!</strong> WE WILL REACH THERE SOON
	   <button type="button" class="btn btn-default"><a href="pro.php">BACK</a></button>
      </div>
	  <?php
		echo "inserted successfully";
		}
	 else
	  {
		echo "error".$sql."<br>".mysqli_error($con);
	  }
	}
	else{
		echo "<script>alert('image unsupported format');</script>";
		header("Location:getPosition.php?lat=".$lat."&lng=".$log);
	}
	function compressedimage($source, $destination, $quality) {

		$info = getimagesize($source);
	
		if ($info['mime'] == 'image/jpeg') 
			$image = imagecreatefromjpeg($source);
	
		elseif ($info['mime'] == 'image/gif') 
			$image = imagecreatefromgif($source);
	
		elseif ($info['mime'] == 'image/png') 
			$image = imagecreatefrompng($source);
	
		imagejpeg($image, $destination, $quality);
	}
mysqli_close($con);
?>
</head>
<body>

</body>
</html>