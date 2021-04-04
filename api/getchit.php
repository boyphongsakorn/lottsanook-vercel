<?php
error_reporting(E_ERROR | E_PARSE);
header('Access-Control-Allow-Origin: *');
$url = "https://www.lottovip.co/%E0%B8%AB%E0%B8%A7%E0%B8%A2%E0%B9%84%E0%B8%97%E0%B8%A2%E0%B8%A3%E0%B8%B1%E0%B8%90/";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
$dom = new DOMDocument();
$dom->loadHTML($response);
$dom->preserveWhiteSpace = false;
$el = $dom->getElementsByTagName('img');
$a=array();
foreach($el as $val){
    //if ($val -> getAttribute('class') == 'attachment-large size-large'){
        //if (strpos($val -> getAttribute('src'),"data:image") !== 0){
            //echo $val -> getAttribute('class');
            //echo '<br>';
            if (strpos($val -> getAttribute('src'),"ไทยรัฐ") !== false){
                //echo $val -> getAttribute('class');
                //echo '<br>';
                //echo $val -> getAttribute('src');
                //echo '<br>';
                array_push($a,$val -> getAttribute('src'));
            }
            if (strpos($val -> getAttribute('src'),"เดลินิวส์") !== false){
                //echo $val -> getAttribute('class');
                //echo '<br>';
                //echo $val -> getAttribute('src');
                //echo '<br>';
                array_push($a,$val -> getAttribute('src'));
            }
        //}
    //}
    if (strpos($val -> getAttribute('src'),"บางกอกทูเดย์") !== false){
        //echo $val -> getAttribute('class');
        //echo '<br>';
        //echo $val -> getAttribute('src');
        //echo '<br>';
        array_push($a,$val -> getAttribute('src'));
    }
    if(count($a) == 3){
        echo json_encode($a);
        exit();
    }
}
?>