<html>
<head>
<script>
getLocation();

function getLocation(){
  if (navigator.geolocation){
        //show the geolocation position
        navigator.geolocation.getCurrentPosition(showPosition);
    }
    else{
        //not support HTML5 geolocation

    }
  }

function showPosition(position){
    //document.getElementById("geo").innerHTML = "latitude-longitude from HTML5 (" + position.coords.latitude + "," + position.coords.longitude + ")";
    var latitude=position.coords.latitude;
    var longitude=position.coords.longitude;
    
       window.location.href = "location_control.php?w1=" + latitude + "&w2=" + longitude;

     
  }

</script>
</head>
<body>
<div id="geo">
    <?php
        require_once('IP2Location.php');
        $loc = new IP2Location('IP2LOCATION-LITE-DB5.BIN', IP2Location::FILE_IO);

        //Latitude and Longitude from IP
        $ip = $_SERVER['REMOTE_ADDR'];
        $latitude = $loc->lookup($ip, IP2Location::LATITUDE);
        $longitude = $loc->lookup($ip, IP2Location::LONGITUDE);

        echo "latitude-longitude from BIN ($latitude,$longitude)";
        
        
    ?>
</div>
</body>
</html>