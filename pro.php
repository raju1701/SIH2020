<?php 
session_start();
include 'connection.php';



?>
<!DOCTYPE html>
<html>
<head>



<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body >
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
        <li class="active"><a href="#">Home</a></li>
        <li style="background:black;"><a href="sam2.php" style="color:white;" >EMERGENCY</a></li>
        <li style="background:black;"><a href="maps.php" style="color:white;">SAFTEY</a></li>
        <li style="background:black;"><a href="aler.php" style="color:white;">ALERT</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.php" style="background:black;"><span class="glyphicon glyphicon-user" style="color:white;"></span> PROFILE</a></li>
        <li><a href="logout.php" style="background:black;"><span class="glyphicon glyphicon-log-in"style="color:white;"></span> LOGOUT</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron" style="margin-top:50px; height:95vh;">
<div  id="myMap" src=" " style="width:100%; height:100%;"> </div>
</div>

<p id="demo"></p>
<script>
 
var infobox;
  function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      alert("User denied the request for Geolocation.");
      break;
    case error.POSITION_UNAVAILABLE:
      alert( "Location information is unavailable.");
      break;
    case error.TIMEOUT:
      alert( "The request to get user location timed out.");
      break;
    case error.UNKNOWN_ERROR:
     alert( "An unknown error occurred.");
      break;
  }
}
function GetMap(lat,lng)
    {
		 map = new Microsoft.Maps.Map('#myMap', {});
		 infobox = new Microsoft.Maps.Infobox(map.getCenter(), {visible: false});
            infobox.setMap(map);
		if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position)
	{
	  
	       var loc = new Microsoft.Maps.Location(position.coords.latitude,position.coords.longitude);
           var pin = new Microsoft.Maps.Pushpin(loc);
           map.setView({ center: loc, zoom: 15 }); 
            Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
           var searchManager = new Microsoft.Maps.Search.SearchManager(map);
            var reverseGeocodeRequestOptions = {
           location: new Microsoft.Maps.Location(position.coords.latitude,position.coords.longitude),
            callback: function (answer, userData) {
            map.setView({ bounds: answer.bestView });
            map.entities.push(new Microsoft.Maps.Pushpin(reverseGeocodeRequestOptions.location));
            pin.metadata ={
			title:answer.address.formattedAddress};
		
        }
    };
    searchManager.reverseGeocode(reverseGeocodeRequestOptions);
   
});
 Microsoft.Maps.Events.addHandler(pin, 'click', pushpinClicked);
map.entities.push(pin);

	    
		
		
	},showError);
  } 
  else { 
   alert("browser not supported")
  }
 
}
function pushpinClicked(e) {
        //Make sure the infobox has metadata to display.
        if (e.target.metadata) {
            //Set the infobox options with the metadata of the pushpin.
            infobox.setOptions({
                location: e.target.getLocation(),
                title: e.target.metadata.title,
                visible: true
            });
        }
    }
</script>
<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AqbaiEI-XekLlrt7vTBA7ZMVEKSdO6Fz7oDsQ4gvNFT2QpihbKP6mfNcezi4LqXD' async defer></script>
<?php
echo $_SESSION['uname'];

$lat=$lat=(isset($_GET['lat']))?$_GET['lat']:'';
$long=(isset($_GET['log']))?$_GET['log']:'';

 $baseURL="http://dev.virtualearth.net/REST/v1/Locations";    
  $point ="$lat,$long";  
  $key = 'AqbaiEI-XekLlrt7vTBA7ZMVEKSdO6Fz7oDsQ4gvNFT2QpihbKP6mfNcezi4LqXD'; 
  $revGeocodeURL = $baseURL."/".$point."?output=xml&key=".$key;  
  $rgOutput = file_get_contents($revGeocodeURL);  
  $rgResponse = new SimpleXMLElement($rgOutput,true);  
  $address = (string) $rgResponse->ResourceSets->ResourceSet->Resources->Location->Address->FormattedAddress;

$uname=$_SESSION['uname'];
$query="UPDATE users SET latitude='$lat',longitude='$long',address='$address',status='0' WHERE email='$uname'";
$q1=mysqli_query($con,$query);
/*$query1="SELECT * FROM users  WHERE email='.$uname.'";
$q2=mysqli_query($con,$query1);
if(mysqli_num_rows($q2)>0){
while($row=mysqli_fetch_assoc($q2)){
$arr1[]=array($row['email1'],$row['email2']);
print_r($arr1);
echo $row['email1'];
echo $row['email2'];
}	

}


/*foreach ($arr1 as $v){
$query2="SELECT * FROM users  WHERE email='$v'";
$q3=mysqli_query($con,$query2);
if(mysqli_num_rows($q2)>0){
while($row=mysqli_fetch_assoc($q3)){
	$a=array('latitude'=>$row['latitude'],'longitude'=>$row['longitude'],'address'=>$row['address'],'name'=>$row['user']);
		$arr[]=$a;
}	
}	
}*/

?>
</body>
</html>