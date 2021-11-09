<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
if (empty($_GET['date'])) {
    $_GET['date'] = date("d").date("m").(date("Y")+543);
}
$filename = $_GET['date'].".txt";
$day = substr($_GET['date'], 0,2);
$month = substr($_GET['date'], 2,2);
$year = substr($_GET['date'], 4,4);
/*if ($year == date('Y')+543) {
    if (isset($_GET['from'])) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://lottsanook.vercel.app/api/index3.php?date='.$_GET['date'].'&from');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
    }else{
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://lottsanook.vercel.app/api/index3.php?date='.$_GET['date']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
    }
    exit();
}*/
switch ($month)
    {
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
/*if ($year == date('Y')+543) {
    if (isset($_GET['from'])) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://lottsanook.herokuapp.com/index2.php?date='.$_GET['date'].'&from');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
    }else{
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://lottsanook.herokuapp.com/index2.php?date='.$_GET['date']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
    }
    exit();
}*/
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
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.glo.or.th/api/lottery/getLotteryAward',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"date": "'.$day.'", "month": "'.$month.'", "year": "'.(intval($year)-543).'"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$response = json_decode($response, true);

if(empty($response["response"])){
    if ($year == date('Y')+543) {
        if (isset($_GET['from'])) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://lottsanook.herokuapp.com/index2.php?date='.$_GET['date'].'&from');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            echo $response;
        }else{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://lottsanook.herokuapp.com/index2.php?date='.$_GET['date']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            echo $response;
        }
        exit();
    }
    //echo json_encode($lottapi);
    exit();
}

$lottapi[0][1] = $response["response"]["data"]["first"]["number"][0]["value"];

foreach ($response["response"]["data"]["last3f"]["number"] as $key=>$value) {

    $lottapi[1][$key+1] = $value["value"];

}

foreach ($response["response"]["data"]["last3b"]["number"] as $key=>$value) {

    $lottapi[2][$key+1] = $value["value"];
  
}

$lottapi[3][1] = $response["response"]["data"]["last2"]["number"][0]["value"];

foreach ($response["response"]["data"]["near1"]["number"] as $key=>$value) {

    $lottapi[4][$key+1] = $value["value"];
  
}

foreach ($response["response"]["data"]["second"]["number"] as $key=>$value) {

    $lottapi[5][$key+1] = $value["value"];
  
}

foreach ($response["response"]["data"]["third"]["number"] as $key=>$value) {

    $lottapi[6][$key+1] = $value["value"];
  
}

foreach ($response["response"]["data"]["fourth"]["number"] as $key=>$value) {

    $lottapi[7][$key+1] = $value["value"];
  
}

foreach ($response["response"]["data"]["fifth"]["number"] as $key=>$value) {

    $lottapi[8][$key+1] = $value["value"];
  
}

echo json_encode($lottapi);
if (isset($_GET['from'])) {
    $lottapi[0][0] = "รางวัลที่1";
}

if (!empty($response["response"]) && (date('H:i:s') > '16:00:00' && date('H:i:s') < '14:30:00')) {
    $myfile = fopen("cache/".$filename, "w") or die("Unable to open file!");
    fwrite($myfile, json_encode($lottapi));
    fclose($myfile);
}
?>
