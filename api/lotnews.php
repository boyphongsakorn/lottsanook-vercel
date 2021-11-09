<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$countnumber = array(); 
//mod by 3
if(isset($_GET['count'])){
  if(intval($_GET['count'])%3 == 0){
    $countnumber[0] = intval($_GET['count'])/3;
    $countnumber[1] = intval($_GET['count'])/3;
    $countnumber[2] = intval($_GET['count'])/3;
  }else{
    if(intval($_GET['count'])%3 == 1){
      //round down
      $countnumber[0] = floor(intval($_GET['count'])/3);
      //round up
      $countnumber[1] = ceil(intval($_GET['count'])/3);
      $countnumber[2] = floor(intval($_GET['count'])/3);
    }else{
      //round down
      $countnumber[0] = floor(intval($_GET['count'])/3);
      //round up
      $countnumber[1] = ceil(intval($_GET['count'])/3);
      $countnumber[2] = ceil(intval($_GET['count'])/3);
    }
  }
}

$cars = array(); 

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.brighttv.co.th/tag/เลขเด็ด/feed',
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
//echo $response;

$xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
$json = json_encode($xml);
$array = json_decode($json,TRUE);
//print_r($array);
//loop news 5 times
//print_r($array);
for($i=0;$i<$countnumber[0];$i++){
    $title = $array['channel']['item'][$i]['title'];
    $link = $array['channel']['item'][$i]['link'];
    $description = mb_substr(strip_tags($array['channel']['item'][$i]['description']),0,100,'UTF-8').'...';
    $pubDate = $array['channel']['item'][$i]['pubDate'];
    //$image = $array['channel']['item'][$i]['enclosure']['@attributes']['url'];
    //cut description to 100 char and add ...
    $a=array($title,$link,$description,$pubDate);
    array_push($cars,$a);
}

$xml=simplexml_load_file("https://www.khaosod.co.th/tag/เลขเด็ด/feed", 'SimpleXMLElement', LIBXML_NOCDATA) or die("Error: Cannot create object");
//for 5 times
for($i=0;$i<$countnumber[1];$i++){
    $title = strval($xml->channel->item[$i]->title);
    $link = strval($xml->channel->item[$i]->link);
    //cut description to 100 char and add ...
    $description = mb_substr(strip_tags($xml->channel->item[$i]->description),0,100,'UTF-8').'...';
    $pubDate = strval($xml->channel->item[$i]->pubDate);
    $content = $xml->channel->item[$i]->children('media', true)->content;
    $image = strval($content->attributes()['url']);
    //echo $image;
    $a=array($title,$link,$description,$image,$pubDate);
    array_push($cars,$a);
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.brighttv.co.th/tag/หวยแม่น้ำหนึ่ง/feed',
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
//echo $response;

//get items from xml
$xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
$json = json_encode($xml);
$array = json_decode($json,TRUE);
//print_r($array);
//loop news 5 times
//print_r($array);
for($i=0;$i<$countnumber[2];$i++){
    $title = $array['channel']['item'][$i]['title'];
    $link = $array['channel']['item'][$i]['link'];
    $description = mb_substr(strip_tags($array['channel']['item'][$i]['description']),0,100,'UTF-8').'...';
    $pubDate = $array['channel']['item'][$i]['pubDate'];
    //$image = $array['channel']['item'][$i]['enclosure']['@attributes']['url'];
    $a=array($title,$link,$description,$pubDate);
    array_push($cars,$a);
}

echo json_encode($cars);
//print_r($json);
?>
