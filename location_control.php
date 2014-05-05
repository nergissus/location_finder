<?php

include_once 'connection.php';

$connection = new createConnection();
$connection->connectToDatabase();
$connection->selectDatabase('test');


$counter=0;
$min_distance=100.0;
$str_name=null;
$str_address=null;

$m_price=20.0;
$c_price=21.4;


$lat=$_GET['w1'];
$long=$_GET['w2'];


if($m_price<$c_price) {
    
$query1 = "SELECT * FROM store_location WHERE s_type='M'";  }

else {
    
   $query1 = "SELECT * FROM store_location WHERE s_type='C'";  
}

$result = mysql_query($query1);


while ($row = @mysql_fetch_assoc($result)){
  
  $latitude = $row['s_lat'];
  $longitude = $row['s_lng'];
  $store_name=$row['s_name'];
  $store_address=$row['s_address'];
  
   $distance[$counter]= getDistanceFromLatLonInKm($latitude, $longitude, $lat, $long);
 
  if($distance[$counter]<$min_distance) {
      
      $min_distance=$distance[$counter];
      $str_name=$store_name;
      $str_address=$store_address;
 
}

$counter=$counter+1;
   
}
 
echo "The name of the shopping center which is closest to you is: $str_name";

echo "The distance between your location and $str_name is: $min_distance km";

echo "The address of $str_name is: $str_address";



//fonksiyon iki nokta arasındaki mesafeyi kilometre cinsinden buluyor
function getDistanceFromLatLonInKm($lat1, $lon1, $lat2, $lon2) {

  $theta = $lon1 - $lon2;

  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));

  $dist = acos($dist);

  $dist = rad2deg($dist);

  $miles = $dist * 60 * 1.1515;

  return ($miles * 1.609344);

}

?>