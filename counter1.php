<?php
require_once('AccessCounter.php');

//-----------------------------------
// カウンターの値を取得
//-----------------------------------
try{
  $counter = new AccessCounter();
  $number  = $counter->getCount();  // カウンターの値を取得
  $counter->addCount();             // カウンターを加算
  $counter->finish();               // 終了処理
}
catch(Exception $e){
  echo $e->getMessage();
  exit;
}
?><!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>カウンター1</title>
</head>
<body>
あなたは当ページを訪れた累計<?= $number ?>人目の訪問者です。
</body>
</html>