<?php
error_reporting(E_ERROR | E_PARSE);
header('Access-Control-Allow-Origin: *');
date_default_timezone_set("Asia/Bangkok");
//header('Content-Type: image/jpeg');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <?php

    if(isset($_GET['date'])){
        $nowtime = $_GET['date'];
    }else{
        $nowtime = date("dm").date("Y")+543;
        if (strlen($nowtime) == 7) {
            $nowtime = sprintf("%08d",date("dm").date("Y")+543);
        }
    }

    $json = file_get_contents('https://lottsanook.vercel.app/api/?date='.$nowtime.'&fresh');

    $obj = json_decode($json);

    switch (date("m",strtotime(substr($nowtime,2,2)."/".substr($nowtime,0,2)."/".substr($nowtime,4,4))))
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
    
    ?>
    <style>
        body {
            font-family: 'Mitr', sans-serif;
            <? if($obj != ""){ ?>
                <? if(count($obj[2]) == 5) { ?>
                    background-image: url(fbbg_older.png);
                <? } else { ?>
                    <? if(isset($_GET['rm'])) { ?>
                        background-image: url(fbbg_rmbn.png);
                    <? } else { ?>
                    background-image: url(fbbg.png);
                    <? } ?>
                <? } ?>
            <? } else { ?>
                background-image: url(fbbg_older.png);
            <? } ?>
            color: white;
        }
    </style>
</head>
<body>
    <h1 style="margin-top: 150px;margin-left: 180px;font-size: 80px;">ผลรางวัลสลากกินแบ่งรัฐบาล</h1>
    <h2 style="margin-top: 15px;margin-left: 0px;font-size: 50px;margin-right: 590px;text-align: right;">เมื่อประจำวันที่ <?php echo date("j",strtotime(substr($nowtime,2,2)."/".substr($nowtime,0,2)."/".substr($nowtime,4,4))); ?> <?php echo $monthtext; ?> <?php echo date("Y",strtotime(substr($nowtime,2,2)."/".substr($nowtime,0,2)."/".substr($nowtime,4,4))); ?></h2>
    <h2 style="margin-top: 50px;font-size: 80px;margin-left: 450px;">รางวัลที่ 1</h2>
    <h2 style="font-size: 12.25vw;margin-left: 190px;margin-top: -40px;margin-right: 650px;text-align: center;"><?php echo $obj[0][1]; ?></h2>
    <h2 style="margin-left: 1095px;margin-top: -255px;font-size: 50px;">เลขท้าย สองตัว</h2>
    <h2 style="margin-left: 1120px;font-size: 150px;margin-top: -10px;"><?php echo $obj[3][1]; ?></h2>
    <? if(count($obj[2]) == 5) { ?>
        <h2 style="margin-top: 25px;margin-left: 575px;font-size: 60px;">เลขท้าย สามตัว</h2>
        <h2 style="font-size: 100px;margin-left: 260px;"><?php echo $obj[2][1]; ?> | <?php echo $obj[2][2]; ?> | <?php echo $obj[2][3]; ?> | <?php echo $obj[2][4]; ?></h2>
    <? } else { ?>
        <h2 style="margin-top: 25px;margin-left: 325px;font-size: 60px;">เลขหน้า สามตัว</h2>
        <h2 style="font-size: 100px;margin-left: 260px;"><?php echo $obj[1][1]; ?> | <?php echo $obj[1][2]; ?></h2>
        <h2 style="margin-left: 875px;margin-top: -207px;font-size: 60px;">เลขท้าย สามตัว</h2>
        <h2 style="font-size: 5.96vw;margin-left: 805px;max-width: 475px;"><?php echo $obj[2][1]; ?> | <?php echo $obj[2][2]; ?></h2>
    <? } ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
</body>
</html>