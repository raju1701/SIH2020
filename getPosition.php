<!DOCTYPE html>
<html>
<head>
    <style>
    ::placeholder{
    color:Dodgerblue;
    }
   button{
       background: linear-gradient(to bottom, #33ccff 0%, #ff99cc 100%);
       border:none;
       outline:none;
       color:white;
       transition:0.3 ease;
   }
   button:hover{
       transform:scale(1.2);
   }
    </style>
<?php
 session_start();
 $lat=(isset($_GET['lat']))?$_GET['lat']:'';
 $long=(isset($_GET['log']))?$_GET['log']:'';
 
 $_SESSION['lat']=$lat;
 $_SESSION['log']=$long;

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript">
  function validate(){
   var x=document.getElementById('t');
   var y=document.getElementById('file');
   var z=document.getElementById('drop');
   if(z.value==" "){
   alert("plzz select one");
   return false;
   
   }
   if((x.value.trim()=="") || (y.file.length==0) ){
	   alert("plzz enter the feilds");
	   return false;
    }
   return true;
   }
		    function runSpeechRecognition() {
		       
		        var output = document.getElementById("output");
		        
		        var action = document.getElementById("action");
               
                var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
                var recognition = new SpeechRecognition();
            
                
                recognition.onstart = function() {
                    action.innerHTML = "<small>listening, please speak...</small>";
                };
                
                recognition.onspeechend = function() {
                    action.innerHTML = "<small>stopped listening, hope you are done...</small>";
                    recognition.stop();
                }
              
                // This runs when the speech recognition service returns result
                recognition.onresult = function(event) {
                    var transcript = event.results[0][0].transcript;
                    var confidence = event.results[0][0].confidence;
                    output.innerHTML = transcript;
                    output.classList.remove("hide");
                };
              
                 // start recognition
                 recognition.start();
	        }
   </script>
</head>
<body style="background-image:url('1551099.jpg'); background-size:cover; background-position:center; background-repeat:no-repeat">
<?php
$baseURL="http://dev.virtualearth.net/REST/v1/Locations";    
  $point ="$lat,$long";  
  $key = 'AqbaiEI-XekLlrt7vTBA7ZMVEKSdO6Fz7oDsQ4gvNFT2QpihbKP6mfNcezi4LqXD'; 
  $revGeocodeURL = $baseURL."/".$point."?output=xml&key=".$key;  
  $rgOutput = file_get_contents($revGeocodeURL);  
  $rgResponse = new SimpleXMLElement($rgOutput,true);  
  $address = (string)$rgResponse->ResourceSets->ResourceSet->Resources->Location->Address->FormattedAddress;
 $_SESSION['locality']=$address;

?>
<div class="container" style=" height:90%; width:100% align-item:center;  margin:70px auto;" >

<form action="ass.php" onsubmit="return validate()" method="post" enctype="multipart/form-data"  style="background:rgba(0,0,0,0.5) ; width:350px; height:400px; margin:70px auto;">
<textarea id="output" id="tt"; name="t" rows="6" cols="30" style=" color:Dodgerblue; margin-top:30px; background:none; border:5px solid Dodgerblue; border-radius:10px; padding:5px;  margin-left:50px;" placeholder="ENTER YOUR EMERGENCY" Required></textarea><br>
<button type="button" id="action" onclick="runSpeechRecognition()" style=" margin-left:90px; width:150px;">record</button>
<input type="file" id="file" name="file" style="margin-top:40px; margin-left:90px; width:250px;" accept="image/*" capture="camera" Required><br>
<select id="drop" name="drop" style="margin-top:10px;width:150px;  margin-left:90px;" Required>
<option value=" NEAREST STATION ">STATION</option>
<option value="ATTIBELE">ATTIBELE</option>
<option value="SARJAPURA">SARJAPURA</option>
<option value="ANEKAL">ANEKAL</option>
</select><br>
<button type="submit" name="submit" style="margin-top:20px; width:150px;  margin-left:90px; border-radius:5px;" >SEND</submit>
</form>
</div>

</body>
</html>