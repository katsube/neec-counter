<?php
require_once('AccessCounter.php');

//-----------------------------------
// カウンターの値を取得
//-----------------------------------
try{
  $counter = new AccessCounter();
  $number  = $counter->getCount();  // カウンターの値を取得
  $counter->addCount($number);      // カウンターを加算
  $counter->finish();               // 終了処理
}
catch(Exception $e){
  echo $e->getMessage();
  exit;
}

//-----------------------------------
// imgタグを生成
//-----------------------------------
$html = '';    // 最終的に出力する
$numbers = str_split((string)$number);  //1文字ずつ分割し、配列にする
for($i=0; $i<count($numbers); $i++){
  $html .= sprintf('<img src="image/number%02d_s.png">', $numbers[$i]);
}

?><!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>カウンター2</title>
</head>
<body>
あなたは当ページを訪れた累計<?= $html ?>人目の訪問者です。
</body>
</html>