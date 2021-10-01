<?php
error_reporting(E_ERROR | E_PARSE);
header('Access-Control-Allow-Origin: *');
/*if(strlen($_GET['search']) != 6){
    echo "error";
    exit();
}*/
if(isset($_GET['by'])){
    $date=sprintf("%08d", $_GET['by']);
}
/*if(file_exists("/tmp/".$date.".txt")){
    $myfile = fopen("/tmp/".$date.".txt","r") or die("Unable to open file!");
    $yourlot = fread($myfile,filesize("/tmp/".$date.".txt"));
}else{*/
    $url = "https://lottsanook.vercel.app/api/index2?date=".$date."&fresh";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    $yourlot = $response;
//}
$lot_array  = json_decode($yourlot);
echo $yourlot;
/*if($lot_array[0][1] == $_GET['search']){
    echo "hee";
}*/
foreach($lot_array as $x => $val) {
    foreach($val as $y => $superval) {
        //echo "$x and $y = $val<br>";
        echo substr($_GET['search'],0,3);
        echo substr($_GET['search'],-3,3);
        echo substr($_GET['search'],-2,2);
        if($superval == $_GET['search'] || $superval == substr($_GET['search'],0,3) || $superval == substr($_GET['search'],-3,3) || $superval == substr($_GET['search'],-2,2) && $y != 0){
            //echo "hee";
            if($x == 0){
                //echo "111111";
                $result .= "111111,";
            }
            if($x == 1){
                //echo "111111";
                $result .= "333000,";
            }
            if($x == 2){
                //echo "111111";
                $result .= "000333,";
            }
            if($x == 3){
                //echo "111111";
                $result .= "000022,";
            }
            if($x == 4){
                //echo "111112";
                $result .= "111112,";
            }
            if($x == 5){
                //echo "222222";
                $result .= "222222,";
            }
            if($x == 6){
                //echo "333333";
                $result .= "333333,";
            }
            if($x == 7){
                //echo "444444";
                $result .= "444444,";
            }
            if($x == 8){
                //echo "555555";
                $result .= "555555,";
            }
            //echo $superval;
        }
        //echo $superval;
    }
    /*if($lot_array[0][1] == $_GET['search']){
        echo "hee";
    }*/
}
//echo $result;
echo substr($result, 0, -1);
?>
