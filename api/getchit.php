<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$url = "https://www.huayvips.com/luckynumber/";
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
            if (strpos($val -> getAttribute('src'),"TL") !== false){
                //echo $val -> getAttribute('class');
                //echo '<br>';
                //echo $val -> getAttribute('src');
                //echo '<br>';
                array_push($a,$val -> getAttribute('src'));
            }
            if (strpos($val -> getAttribute('src'),"DN") !== false){
                //echo $val -> getAttribute('class');
                //echo '<br>';
                //echo $val -> getAttribute('src');
                //echo '<br>';
                array_push($a,$val -> getAttribute('src'));
            }
        //}
    //}
    if (strpos($val -> getAttribute('src'),"BT") !== false){
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
