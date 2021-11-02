<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$curl = curl_init();

if(!empty($_GET["format"])){
    if($_GET["format"] == "thtext"){
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://raw.githubusercontent.com/boyphongsakorn/testrepo/main/godthtext',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
    }else if($_GET["format"] == "combothtext"){
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://raw.githubusercontent.com/boyphongsakorn/testrepo/main/godcombothtext',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
    }
}else{
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://raw.githubusercontent.com/boyphongsakorn/testrepo/main/god',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));
}

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>
