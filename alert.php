
<?php
include 'connection.php';

?>
<!DOCTYPE HTML>
<HTML>

<?php

session_start();
$arr=0;
$lat=(isset($_GET['lat']))?$_GET['lat']:'';
 $long=(isset($_GET['log']))?$_GET['log']:'';
 $uname=$_SESSION['uname'];
 $mob="8861289450";
 $baseURL="http://dev.virtualearth.net/REST/v1/Locations";    
  $point ="$lat,$long";  
  $key = 'AqbaiEI-XekLlrt7vTBA7ZMVEKSdO6Fz7oDsQ4gvNFT2QpihbKP6mfNcezi4LqXD'; 
  $revGeocodeURL = $baseURL."/".$point."?output=xml&key=".$key;  
  $rgOutput = file_get_contents($revGeocodeURL);  
  $rgResponse = new SimpleXMLElement($rgOutput,true);  
  $address = (string)$rgResponse->ResourceSets->ResourceSet->Resources->Location->Address->FormattedAddress;
  $msg="http://maps.google.com/maps/?q=".$lat.",".$long."\n \r  Emergency here &nbsp \n \r ".$address;
 $url="http://maps.google.com/maps/?q=".$lat.",".$long;

 $query="SELECT * from users where email='$uname'";
 $q1=mysqli_query($con,$query);
 if(mysqli_num_rows($q1)>0){
	 while($r=mysqli_fetch_assoc($q1)){
		 $arr=array($r['cont1'],$r['cont2'],$r['cont3'],$r['cont4'],$r['cont5'],$mob);
		 
	 }
	 print_r($arr);
 }
 $s="UPDATE users SET status='1' where email='$uname' ";
 $ss=mysqli_query($con,$s);
 foreach($arr as $x){
	
	echo $x ;
	echo "<br>";
 }
 // Authorisation details.
$apiKey = urlencode('+/4ekFlKjpQ-hBscdDV5E5NJhsxSobmZrj5qVeJqlt');
	
	$numbers = array(918310085985);
	$sender = urlencode('TXTLCL');
	$message = rawurlencode($msg);
 
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

 header("LOCATION:https://api.whatsapp.com/send?text=feeling unsafe ".$url);
 ?>
 <body>
 <!--audio  autoplay controls>
     <source src="Believer_lyrics_video(256kbps).mp3" type="audio/ogg">
     <source src="Believer_lyrics_video(256kbps).mp3" type="audio/mpeg">
</audio-->

<iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fbulwarksih2020.000webhostapp.com%2Fshare.php&layout=button&size=small&appId=837514983443899&width=67&height=20" width="67" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
 </body>
 </html>