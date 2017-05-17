<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>form1表单处理</title>
    <style>
        body {
            font-family: "微软雅黑";
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<h1>汽车配件</h1>
<h2>订单详情</h2>
<?php
// 设定默认时区
date_default_timezone_set('PRC');

echo '<p>下单时间为: ' . date('Y-m-d H:i:s') . '<p/>';
$tireqty = $_POST['tireqty'];
$oilqty = $_POST['oilqty'];
$sparkqty = $_POST['sparkqty'];
$address = $_POST['address'];
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
$date = date('H:i,jS F Y');

$totalqty = 0;
$totalqty = $tireqty + $oilqty + $sparkqty;
echo '商品总订单: ' . $totalqty . '<br/>';
if ($totalqty == 0) {
    echo '您还没有任何订单';
} else {
    if ($tireqty > 0) {
        echo $tireqty . ' tires<br/>';
    }
    if ($oilqty > 0) {
        echo $oilqty . ' oils</br>';
    }
    if ($sparkqty > 0) {
        echo $sparkqty . ' spark plugs<br/>';
    }
    
}

$totalamount = 0.00;
define('TIREPRICE', 100);
define('OILPRICE', 10);
define('SPARKPRICE', 4);
//获取总价格
$totalamount = $tireqty * TIREPRICE + $oilqty * OILPRICE + $sparkqty * SPARKPRICE;
//number_format 用于格式化数字
$totalamount = number_format($totalamount, 2, '.', ',');
echo '总价格为：' . $totalamount . '<br/>';
echo '<p>订单地址为：' . $address . '</p>';

$outputstring = $date . "\t" . $tireqty . " tires \t" . $oilqty . " oil\t" . $sparkqty . " spark plugs\t\$" . $totalamount . "\t" . $address . "\n";
//fopen ab模式是追加，需要原本有txt文件
$fp = fopen("order.txt", 'ab');
//flock用于锁定文件,LOCK_EX是独占锁定(写入)
flock($fp, LOCK_EX);
if (!$fp) {
    echo '<p><strong>您的订单现在不能被处理，请稍候再试</strong></p></body></html>';
    exit;
}
fwrite($fp, $outputstring, strlen($outputstring));
//LOCK_UN是释放锁定
flock($fp, LOCK_UN);
//关闭打开的文件
fclose($fp);
echo '<p>订单处理完毕</p>';
?>
