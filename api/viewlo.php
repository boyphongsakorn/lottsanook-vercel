<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Charm&display=swap');

        body{
            font-family: 'Charm', cursive;
            background-image: url('https://quadbproject.000webhostapp.com/money-1153538_1280.jpg');
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="mb-2 mt-2" style="font-size: 10vh"><center><span class="badge bg-secondary">ผลการออกสลากกินแบ่งรัฐบาล ประจำวันที่ <div id="datetext" class="d-inline"></div> </span></center></div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-success">
                        <center>รางวัลที่1</center>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><center><h3 id="first"> </h3></center></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-info">
                        <center>รางวัลเลขหน้าสามตัว</center>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><center><h3 id="threefirst"> | </h3></center></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-info">
                        <center>รางวัลเลขท้ายสามตัว</center>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><center><h3 id="threeend"> | </h3></center></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-warning">
                        <center>รางวัลเลขท้ายสองตัว</center>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><center><h3 id="twoend"></h3></center></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                Fun Fact
            </div>
            <div class="card-body">
                <div id="numfind" class="d-inline"></div> เคยออกมาแล้ว <div id="numcount" class="d-inline"></div> ครั้ง ในรอบ 13 ปี
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
    <script>
    $.getJSON('https://lottsanook.vercel.app/api/god.php', function(data1) {
        switch (data1[data1.length - 1].substring(2, 4)) {
            case '01':
                month = "มกราคม";
                break;
            case '02':
                month = "กุมภาพันธ์";
                break;
            case '03':
                month = "มีนาคม";
                break;
            case '04':
                month = "เมษายน";
                break;
            case '05':
                month = "พฤษภาคม";
                break;
            case '06':
                month = "มิถุนายน";
                break;
            case '07':
                month = "กรกฎาคม";
                break;
            case '08':
                month = "สิงหาคม";
                break;
            case '09':
                month = "กันยายน";
                break;
            case '10':
                month = "ตุลาคม";
                break;
            case '11':
                month = "พฤศจิกายน";
                break;
            case '12':
                month = "ธันวาคม";
        }

        document.getElementById('datetext').innerText = parseInt(data1[data1.length - 1].substring(0, 2)) + " " + month + " " + data1[data1.length - 1].substring(4, 8)

        $.getJSON('https://lottsanook.vercel.app/api/?date='+data1[data1.length - 1], function(data2) {
            document.getElementById('first').innerText = data2[0][1]
            document.getElementById('threefirst').innerText = data2[1][1]+' | '+data2[1][2]
            document.getElementById('threeend').innerText = data2[2][1]+' | '+data2[2][2]
            document.getElementById('twoend').innerText = data2[3][1]
            randnum = Math.floor((Math.random() * 6) + 1);
            if(randnum == 1){
                numsel = data2[0][1]
            } else if(randnum == 2) {
                numsel = data2[1][1]
            } else if(randnum == 3) {
                numsel = data2[1][2]
            } else if(randnum == 4) {
                numsel = data2[2][1]
            } else if(randnum == 5) {
                numsel = data2[2][2]
            } else if(randnum == 6) {
                numsel = data2[3][1]
            }
            $.getJSON('https://lottsanook.vercel.app/api/finddol.php?search='+numsel, function(data3) {
                document.getElementById('numfind').innerText = numsel
                console.log(data3.length)
                document.getElementById('numcount').innerText = data3.length
            });
        });
    });
    
    </script>
</body>
</html>