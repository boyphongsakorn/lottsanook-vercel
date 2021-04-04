<?php
error_reporting(E_ERROR | E_PARSE);
header('Access-Control-Allow-Origin: *');
$filename = $_GET['date'].".txt";
$day = substr($_GET['date'], 0,2);
$month = substr($_GET['date'], 2,2);
$year = substr($_GET['date'], 4,4);
switch ($month){
    case '01' : $monthtext="มกราคม"; break;
    case '02' : $monthtext="กุมภาพันธ์"; break;
    case '03' : $monthtext="มีนาคม"; break;
    case '04' : $monthtext="เมษายน"; break;
    case '05' : $monthtext="พฤษภาคม"; break;
    case '06' : $monthtext="มิถุนายน"; break;
    case '07' : $monthtext="กรกฎาคม"; break;
    case '08' : $monthtext="สิงหาคม"; break;
    case '09' : $monthtext="กันยายน"; break;
    case '10' : $monthtext="ตุลาคม"; break;
    case '11' : $monthtext="พฤศจิกายน"; break;
    case '12' : $monthtext="ธันวาคม"; break;
}
if (isset($_GET['fresh'])) {
    if(file_exists("cache/".$filename)){
        unlink("cache/".$filename);
    }
}
if(file_exists("cache/".$filename)){
    $myfile = fopen("cache/".$filename,"r") or die("Unable to open file!");
    $readwow = fread($myfile,filesize("cache/".$filename));
    if (isset($_GET['from'])) {
        $readwow = json_decode($readwow, true);
        $readwow[0][0] = $day.' '.$monthtext.' '.$year;
        $readwow = json_encode($readwow);
    }
    echo $readwow;
    fclose($myfile);
    exit();
}
$url = "https://news.sanook.com/lotto/check/".$_GET['date']."/";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
$dom = new DOMDocument();
//echo $response;
if($response == ""){
    echo json_encode(array(array("รางวัลที่1",0),array("เลขหน้า3ตัว",0,0),array("เลขท้าย3ตัว",0,0),array("เลขท้าย2ตัว",0),array("รางวัลข้างเคียงรางวัลที่1",0,0),array("รางวัลที่2",0,0,0,0,0),array("รางวัลที่3",0,0,0,0,0,0,0,0,0,0),array("รางวัลที่4",0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),array("รางวัลที่5",0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),));
    exit();
}
$dom->loadHTML($response);
$dom->preserveWhiteSpace = false;
$bigel = $dom->getElementsByTagName('strong');
$el = $dom->getElementsByTagName('span');
$lottapi = array (
    array("รางวัลที่1",0),
    array("เลขหน้า3ตัว",0,0),
    array("เลขท้าย3ตัว",0,0),
    array("เลขท้าย2ตัว",0),
    array("รางวัลข้างเคียงรางวัลที่1",0,0),
    array("รางวัลที่2",0,0,0,0,0),
    array("รางวัลที่3",0,0,0,0,0,0,0,0,0,0),
    array("รางวัลที่4",0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
    array("รางวัลที่5",0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
);
if (isset($_GET['from'])) {
    $lottapi[0][0] = $day.' '.$monthtext.' '.$year;
}
$minwave = 0;
$maxwave = 5;
foreach($el as $val){
    if ($val -> getAttribute('class') == 'lotto__number' || $val -> getAttribute('class') == 'default-font--reward') {
        if ($minwave >= 1 && $minwave <= $maxwave) {
            $lottapi[$wave][$minwave] = $val ->nodeValue;
            $minwave++;
        } else {
            $minwave = 0;
        }
        if ($val ->nodeValue == 'ผลสลากกินแบ่งรัฐบาล รางวัลที่ 2 มี 5 รางวัลๆละ 200,000 บาท' || $val ->nodeValue == 'ผลสลากกินแบ่งรัฐบาล รางวัลที่ 2 มี 5 รางวัลๆละ 100,000 บาท') {
            $minwave += 1;
            $maxwave = 5;
            $wave = 5;
        }
        if ($val ->nodeValue == 'ผลสลากกินแบ่งรัฐบาล รางวัลที่ 3 มี 10 รางวัลๆละ 80,000 บาท' || $val ->nodeValue == 'ผลสลากกินแบ่งรัฐบาล รางวัลที่ 3 มี 10 รางวัลๆละ 40,000 บาท') {
            $minwave += 1;
            $maxwave = 10;
            $wave = 6;
        }
        if ($val ->nodeValue == 'ผลสลากกินแบ่งรัฐบาล รางวัลที่ 4 มี 50 รางวัลๆละ 40,000 บาท' || $val ->nodeValue == 'ผลสลากกินแบ่งรัฐบาล รางวัลที่ 4 มี 50 รางวัลๆละ 20,000 บาท') {
            $minwave += 1;
            $maxwave = 50;
            $wave = 7;
        }
        if ($val ->nodeValue == 'ผลสลากกินแบ่งรัฐบาล รางวัลที่ 5 มี 100 รางวัลๆละ 20,000 บาท' || $val ->nodeValue == 'ผลสลากกินแบ่งรัฐบาล รางวัลที่ 5 มี 100 รางวัลๆละ 10,000 บาท') {
            $minwave += 1;
            $maxwave = 100;
            $wave = 8;
        }
    }
    if ($val ->nodeValue == 'รางวัลที่ 1') {
        $lottapi[0][1] = $bigel[0] ->nodeValue;
    } else if ($val ->nodeValue == 'เลขหน้า 3 ตัว') {
        $lottapi[1][1] = $bigel[1] ->nodeValue;
        $lottapi[1][2] = $bigel[2] ->nodeValue;
    } else if ($val ->nodeValue == 'เลขท้าย 3 ตัว') {
        if (substr($_GET['date'],4,4) <= 2558) {
            if (substr($_GET['date'],2,2) <= 8 && substr($_GET['date'],4,4) <= 2558 || substr($_GET['date'],4,4) < 2558) {
                $lottapi[2][1] = $bigel[1] ->nodeValue;
                $lottapi[2][2] = $bigel[2] ->nodeValue;
                $lottapi[2][3] = $bigel[3] ->nodeValue;
                $lottapi[2][4] = $bigel[4] ->nodeValue;
            } else {
                $lottapi[2][1] = $bigel[3] ->nodeValue;
                $lottapi[2][2] = $bigel[4] ->nodeValue;
            }
        } else {
            $lottapi[2][1] = $bigel[3] ->nodeValue;
            $lottapi[2][2] = $bigel[4] ->nodeValue;
        }
    } else if ($val ->nodeValue == 'เลขท้าย 2 ตัว') {
        $lottapi[3][1] = $bigel[5] ->nodeValue;
    } else if ($val ->nodeValue == 'รางวัลข้างเคียงรางวัลที่ 1') {
        if (is_numeric($bigel[6] ->nodeValue)) {
            $lottapi[4][1] = $bigel[6] ->nodeValue;
            $lottapi[4][2] = $bigel[7] ->nodeValue;
        } else {
            $lottapi[4][1] = $bigel[7] ->nodeValue;
            $lottapi[4][2] = $bigel[8] ->nodeValue;
        }
    }
}
echo json_encode($lottapi);
if (isset($_GET['from'])) {
    $lottapi[0][0] = "รางวัลที่1";
}
if(preg_match('~[0-9]+~', $lottapi[0][1])){
    $myfile = fopen("cache/".$filename, "w") or die("Unable to open file!");
    fwrite($myfile, json_encode($lottapi));
    fclose($myfile);
}
?>
