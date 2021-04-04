<?php
date_default_timezone_set("Asia/Bangkok");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Mitr', sans-serif;
            background-image: url(fbbg_gold.png);
            color: white;
        }
    </style>
</head>
<body>
    <?php

    $nowtime = date("dm").date("Y")+543;
    if (strlen($nowtime) == 7) {
        $nowtime = sprintf("%08d",date("dm").date("Y")+543);
    }

    if(isset($_GET['test'])){
        $nowtime='01022563';
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

    $json_gold = file_get_contents('https://thai-gold-api.herokuapp.com/latest');

    $obj_gold = json_decode($json_gold, true);
    
    ?>
    <h1 style="margin-top: 15px;margin-left: 5px;font-size: 65px;">ผลรางวัลสลากกินแบ่งรัฐบาล</h1>
    <h2 style="margin-top: 40px;margin-left: 0px;font-size: 50px;margin-right: 450px;text-align: right;">เมื่อประจำวันที่ <?php echo date("j",strtotime(substr($nowtime,2,2)."/".substr($nowtime,0,2)."/".substr($nowtime,4,4))); ?> <?php echo $monthtext; ?> <?php echo date("Y",strtotime(substr($nowtime,2,2)."/".substr($nowtime,0,2)."/".substr($nowtime,4,4))); ?></h2>
    <h2 style="margin-top: 63px;font-size: 30px;margin-left: 0px;">รางวัลที่ 1</h2>
    <h2 style="font-size: 8vw;margin-left: 0px;margin-top: -35px;margin-right: 800px;text-align: center;"><?php echo $obj[0][1]; ?></h2>
    <h2 style="margin-top: 20px;font-size: 30px;">เลขหน้า สามตัว</h2>
    <h2 style="font-size: 100px;margin-left: 147px;margin-top: -15px;"><?php echo $obj[1][1]; ?> | <?php echo $obj[1][2]; ?></h2>
    <h2 style="margin-left: 0px;font-size: 30px;margin-top: 37px;">เลขท้าย สามตัว</h2>
    <h2 style="font-size: 5.96vw;margin-left: 180px;max-width: 475px;margin-top: -10px;"><?php echo $obj[2][1]; ?> | <?php echo $obj[2][2]; ?></h2>
    <h2 style="margin-top: 25px;font-size: 30px;position: fixed;">เลขท้าย สองตัว</h2>
    <h2 style="margin-left: 300px;font-size: 150px;margin-top: 22px;position: fixed;"><?php echo $obj[3][1]; ?></h2>
    <h1 style="margin-top: -765px;margin-left: 1010px;font-size: 65px;position: fixed;">ราคาทองวันนี้</h1>
    <h1 style="margin-top: -525px;margin-left: 820px;font-size: 65px;position: fixed;">ทองคำ</h1>
    <h1 style="margin-top: -390px;margin-left: 850px;font-size: 65px;position: fixed;"><?php echo $obj_gold['response']['price']['gold']['buy']; ?> | <?php echo $obj_gold['response']['price']['gold']['sell']; ?></h1>
    <h1 style="margin-top: -250px;margin-left: 800px;font-size: 60px;position: fixed;background-color: gold;padding-top: 7px;padding-left: 5px;padding-right: 5px;">ทองคำแท่ง</h1>
    <h1 style="margin-top: -110px;margin-left: 827px;font-size: 65px;position: fixed;"><?php echo $obj_gold['response']['price']['gold_bar']['buy']; ?> | <?php echo $obj_gold['response']['price']['gold_bar']['sell']; ?></h1>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
</body>
</html>