<?php include 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
$arr=array();
$query="SELECT * FROM latlang";
$sql=mysqli_query($con,$query);
if(mysqli_num_rows($sql)>=1){
	while($row=mysqli_fetch_assoc($sql))
	{
		$a=array('latitude'=>$row['latitude'],'longitude'=>$row['longitude'],'address'=>$row['address'],'comments'=>$row['comments'],'cases'=>$row['cases']);
		$arr[]=$a;
		
	}
	
}

?>

    <title></title>
    <meta charset="utf-8" />
    <script type='text/javascript'>
	    var obj=<?php echo json_encode($arr);?>;
		var pin,Infobox;
        var info1;
        var add;
		console.log(obj);
        var map;
        var directionsManager;
        var address;
        function GetMap()
        {
			
            map = new Microsoft.Maps.Map('#myMap', {});
			
            Microsoft.Maps.loadModule('Microsoft.Maps.Directions', function () {
                //Create an instance of the directions manager.
                directionsManager = new Microsoft.Maps.Directions.DirectionsManager(map);

                //Specify where to display the route instructions.
                directionsManager.setRenderOptions({ itineraryContainer: '#directionsItinerary' });

                //Specify the where to display the input panel
                directionsManager.showInputPanel('directionsPanel');
				
				
            });
			navigator.geolocation.getCurrentPosition(function (position) {
            var loc = new Microsoft.Maps.Location(
                position.coords.latitude,
                position.coords.longitude);
                Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
                var searchManager = new Microsoft.Maps.Search.SearchManager(map);
                var reverseGeocodeRequestOptions = {
                location: new Microsoft.Maps.Location(position.coords.latitude,position.coords.longitude),
                callback: function (answer, userData) {
                map.setView({ bounds: answer.bestView });
                map.entities.push(new Microsoft.Maps.Pushpin(reverseGeocodeRequestOptions.location));
                pin.metadata = {
                 title:answer.address.formattedAddress,
                 description: "YOUR LOCATION"
        };
                
        }
    };
    searchManager.reverseGeocode(reverseGeocodeRequestOptions);
});

            //Add a pushpin at the user's location.
            var pin = new Microsoft.Maps.Pushpin(loc);
            map.entities.push(pin);
            info1= new Microsoft.Maps.Infobox(map.getCenter(), {
            visible: false});
            info1.setMap(map);
            Microsoft.Maps.Events.addHandler(pin, 'click', pushpinClicked);

            //Center the map on the user's location.
           // map.setView({ center: loc, zoom: 15 });
 });
		if(obj.length!=0){
			infobox = new Microsoft.Maps.Infobox(map.getCenter(), {
            visible: false
			
        });

        //Assign the infobox to a map instance.
        infobox.setMap(map);
     
        //Create a pushpin at a random location in the map bounds.
        var loc={};
		for(var i=0;i<=obj.length-1;i++)
		{
			
		loc[i]=new Microsoft.Maps.Location(obj[i].latitude,obj[i].longitude)
		if(obj[i].cases>1 && obj[i].cases<3){
        var pin = new Microsoft.Maps.Pushpin(loc[i],{
			icon: 'https://www.bingmapsportal.com/Content/images/poi_custom.png'
		});

        //Store some metadata with the pushpin.
        pin.metadata = {
            title: obj[i].address,
            description: obj[i].comments
        };

        }
		else if(obj[i].cases>3 && obj[i].cases<7){
			var pin = new Microsoft.Maps.Pushpin(loc[i],{
			icon: 'icons8-map-pin-64.png'
		});
        pin.metadata = {
            title: obj[i].address,
            description: obj[i].comments
        };
		}
		else if(obj[i].cases>7 && obj[i].cases<11){
			var pin = new Microsoft.Maps.Pushpin(loc[i],{
			icon: 'icons8-map-pin-48.png'
		});

        //Store some metadata with the pushpin.
        pin.metadata = {
            title: obj[i].address,
            description: obj[i].comments
        };
	}
        Microsoft.Maps.Events.addHandler(pin, 'click', pushpinClicked);

        //Add pushpin to the map.
        map.entities.push(pin);
	}
			 
	}
}
        
		function pushpinClicked(e) {
        //Make sure the infobox has metadata to display.
        if (e.target.metadata) {
            //Set the infobox options with the metadata of the pushpin.
            infobox.setOptions({
                location: e.target.getLocation(),
                title: e.target.metadata.title,
                description: e.target.metadata.description,
                visible: true
            });
        }
    }
	
    </script>
    
	<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AqbaiEI-XekLlrt7vTBA7ZMVEKSdO6Fz7oDsQ4gvNFT2QpihbKP6mfNcezi4LqXD' async defer></script>
    <style>
	  body{
            padding:0;
            margin:0;
            height:100%;
            width:280%;
			overflow-x:auto;
            display:inline-block;
        }

        .directionsContainer{
            width:380px`;
            height:100%;
            overflow-y:auto;
            float:left;
			position:absolute;
		
			
        }

        #myMap{
            position:relative;
            width:100%;
            height:100%;
            float:right;
			
        }
        .jumbotron{
            margin-left:400px;
            width:calc(280%-400px);
            height:100vh;
            background:blue;
        }
	</style>
</head>
<body>
 
 <div class="directionsContainer" >

        <div id="directionsPanel"></div>

        <div id="directionsItinerary"></div>
		
    </div>
    <div class="jumbotron text-center">
        <div id="myMap"></div>	
    </div>	
</body>
</html>