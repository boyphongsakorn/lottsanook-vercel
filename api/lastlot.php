<?php
//ยังใช้งานไม่ได้ในvercel
error_reporting(E_ERROR | E_PARSE);
header('Access-Control-Allow-Origin: *');
$days=json_decode(file_get_contents("https://lottsanook.vercel.app/api/god.php"));
$get=json_decode(file_get_contents("https://lottsanook.vercel.app/api/?date=".end($days)));
echo json_encode(array("win"=>$get[0][1],"threefirst"=>$get[1][1].",".$get[1][2],"threeend"=>$get[2][1].",".$get[2][2],"twoend"=>$get[3][1]));
?>