<!DOCTYPE html>
<html>
<head>
</head>
<body onload="getLocation()">
<script> 
function getLocation(){
if(navigator.geolocation){
	navigator.geolocation.getCurrentPosition(function(pos){
	window.location="alert.php?lat="+pos.coords.latitude+"&log="+pos.coords.longitude;
});
}
}
</script>
 
</body>
</html>