<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://lottsanook.herokuapp.com/finddol.php?search='.$_GET['search'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>
