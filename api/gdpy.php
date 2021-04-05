<?php
error_reporting(E_ERROR | E_PARSE);
header('Access-Control-Allow-Origin: *');
$year = $_GET['year'];
$txtyear = strval($year).".txt";
/*if(file_exists("txtcache/".$txtyear)){
    $myfile = fopen("txtcache/".$txtyear,"r") or die("Unable to open file!");
    echo fread($myfile,filesize("txtcache/".$txtyear));
    fclose($myfile);
    exit();
}*/
$yearlist = array();
$url = "https://www.myhora.com/%E0%B8%AB%E0%B8%A7%E0%B8%A2/%E0%B8%9B%E0%B8%B5-".strval($year).".aspx";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
$peryear = array();
$dom = new DOMDocument();
$dom->loadHTML($response);
$dom->preserveWhiteSpace = false;
$bigel = $dom->getElementsByTagName('font');
foreach($bigel as $val){
    if(is_numeric(strpos($val ->nodeValue, 'ตรวจสลากกินแบ่งรัฐบาล'))){
        $day = explode(" ", substr($val ->nodeValue, 74));
        switch ($day[2]){
            case 'มกราคม' : $monthnum="01"; break;
            case 'กุมภาพันธ์' : $monthnum="02"; break;
            case 'มีนาคม' : $monthnum="03"; break;
            case 'เมษายน' : $monthnum="04"; break;
            case 'พฤษภาคม' : $monthnum="05"; break;
            case 'มิถุนายน' : $monthnum="06"; break;
            case 'กรกฎาคม' : $monthnum="07"; break;
            case 'สิงหาคม' : $monthnum="08"; break;
            case 'กันยายน' : $monthnum="09"; break;
            case 'ตุลาคม' : $monthnum="10"; break;
            case 'พฤศจิกายน' : $monthnum="11"; break;
            case 'ธันวาคม' : $monthnum="12"; break;
        }
        array_unshift($peryear,sprintf("%02d",$day[0]).$monthnum.$day[3]);
    }
}
foreach($peryear as $val){
    array_push($yearlist,$val);
}

/*$file = fopen("txtcache/".strval($year).".txt","w");
fwrite($file,json_encode($yearlist));
fclose($file);*/

echo json_encode($yearlist);
?>