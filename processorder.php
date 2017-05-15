<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>form1表单处理</title>
</head>
<body>
    <h1>汽车配件</h1>
    <h2>订单详情</h2>
    <?php 
        echo '<p>订单处理完毕,时间是: ';
        echo date('H:i,JS F Y');
        echo '</p>';
        $tireqty = $_POST['tireqty'];
        $oilqty =$_POST['oilqty'];
        $sparkqty=$_POST['sparkqty'];

        echo '<p>你的订单列表如下:';
        echo '<br>';
        echo $tireqty.'tires<br>';
        echo $oilqty.'bottle of oil<br>';
        echo $sparkqty.'spark plugs<br>';
        echo '</p>';
    ?>
</body>
</html>