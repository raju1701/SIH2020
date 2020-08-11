<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    form:hover{
        box-shadow:5px 5px 5px 5px solid green;
    }
    ::placeholder{
        color:white;
    }
    .button{
        font-color:white;
        background:Dodgerblue;
        width:150px;
        height:30px;
        border:none;
        border-radius:5px;
    }
    .glow-button:hover {
  color: rgba(255, 255, 255, 1);
  box-shadow: 0 5px 15px rgba(145, 92, 182, .4);
}
    </style>
<script type="text/javascript">
var loc=document.getElementById('searchbox');
var text=document.getElementById('txt');
function validate(){
	if((loc.value.trim()=="") || (text.value.trim())){
		if(loc.value.trim()==""){
			loc.style.border="2px solid red";
			alert("location cant be empty");
			return false;
		}
		else if(text.value.trim()==""){
			text.style.border="2px solid red";
			alert("comments cant be empty");
			return false;
		}
	}
	else
		return true;
}
</script>
</head>
<body  style="background-image:url('pro.jpg'); background-size:cover; background-position:center; background-repeat:no-repeat;" >
<div class="container" style=" height:90%; width:100% align-item:center;  margin:70px auto;">
<form onsubmit="return validate()" action="comments.php" method="post" style="background:rgba(0,0,0,0.5) ; width:350px; height:400px; margin:70px auto;"> 
<div id='myMap' style='width: 5px; height: 5px;'></div>
<input type="hidden" id="hidden1" name="hidden1"/>
<input type="hidden" id="hidden2" name="hidden2"/>
<div id="search" name="search" style="margin-left:50px; margin-top:40px; position:relative;">
<input type="text" id="searchbox" name="searchbox" placeholder="LOCATION" style="background:none; color:white; border:none; border-bottom:2px solid red; width:230px; height:20px; position:relative;"/>
<button class="btn" onclick="getLocation()" type="button" style="border-bottom:2px solid red; background:red;  outline:none; border:none;text-align:center; box-sizing: border-box; position:absolute; height:22px; width:20px;  left:77%;"><i class="fa fa-map-marker"  style=" margin-top:0; bottom:10px;color:white;font-size:20px; "></i></button>
</div><br>
<textarea id="txt" name="text" cols="30" rows="5" placeholder="ENTER THE REASON" style="margin-left:60px; background:none; border:2px solid red;"></textarea><br>
<input type="number" id="number" name="number" placeholder="ENTER NUMBER OF CASES" style=" width:250px;margin-left:50px; margin-top:10px; background:none; border:none; border-bottom:2px solid red;"/><br>

<button class="button glow-button" type="submit" style="margin-left:100px; margin-top:30px;">SUBMIT</button>
</form>
<script>
function loadMapScenario() {
                Microsoft.Maps.loadModule('Microsoft.Maps.AutoSuggest', {
                    callback: onLoad,
                    errorCallback: onError
                });
                function onLoad() {
                    var options = { maxResults: 5 };
                    var manager = new Microsoft.Maps.AutosuggestManager(options);
                    manager.attachAutosuggest('#searchbox', '#search', selectedSuggestion);
                }
                function onError(message) {
                    alert( message);
                }
                function selectedSuggestion(suggestionResult) {
                    document.getElementById('searchbox').innerHTML = suggestionResult.formattedSuggestion;
					document.getElementById('hidden1').value=suggestionResult.location.latitude; 
                    document.getElementById('hidden2').value=suggestionResult.location.longitude;
                            
                }
                
            }

function getLocation(){
if(navigator.geolocation){
navigator.geolocation.getCurrentPosition(function(pos){
document.getElementById('hidden1').value=pos.coords.latitude;
document.getElementById('hidden2').value=pos.coords.longitude;
initmap(pos.coords.latitude,pos.coords.longitude);

});
}
}
function initmap(lat,log){
	var map = new Microsoft.Maps.Map(document.getElementById('myMap'), {});
                Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
                    var searchManager = new Microsoft.Maps.Search.SearchManager(map);
                    var reverseGeocodeRequestOptions = {
                        location: new Microsoft.Maps.Location(lat,log),
                        callback: function (answer, userData) {
                            map.setView({ bounds: answer.bestView });
                            map.entities.push(new Microsoft.Maps.Pushpin(reverseGeocodeRequestOptions.location));
                            document.getElementById('searchbox').value =
                                answer.address.formattedAddress;
                        }
                    };
                    searchManager.reverseGeocode(reverseGeocodeRequestOptions);
                });
}

</script>
<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=AqbaiEI-XekLlrt7vTBA7ZMVEKSdO6Fz7oDsQ4gvNFT2QpihbKP6mfNcezi4LqXD&callback=loadMapScenario' async defer></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>
</html>