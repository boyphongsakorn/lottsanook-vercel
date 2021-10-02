<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.github.com/repos/boyphongsakorn/testrepo/actions/workflows/blank.yml/dispatches',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"inputs":{"number": "578171"},"ref":"refs/heads/main"}',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/vnd.github.v3+json',
    'Authorization: token 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',
    'User-Agent: PostmanRuntime/7.28.4',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

/*$curl = curl_init();

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
echo $response;*/

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://raw.githubusercontent.com/boyphongsakorn/testrepo/main/tmp/'.$_GET['search'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>
