<?php
require_once('AccessCounter.php');

//-----------------------------------
// 定数定義
//-----------------------------------
define('COUNT_IMAGE_WIDTH', 30);     // カウンター画像の横幅(1枚あたり)
define('COUNT_IMAGE_HEIGHT', 35);    // カウンター画像の高さ(1枚あたり)

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
// 画像を結合し出力
//-----------------------------------
// 画像リストを作成
$list = makeImageList($number);

// 最終的に出力する画像の土台を作成
$image = imagecreate(
    COUNT_IMAGE_WIDTH * count($list)  // 横幅
  , COUNT_IMAGE_HEIGHT        // 高さ
);

// 画像を結合
for( $i=0; $i<count($list); $i++ ){
  // 素材画像を1枚読み込む
  $parts = imagecreatefrompng($list[$i]);

  // 土台に素材を貼り付ける
  imagecopy($image, $parts
    , $i * COUNT_IMAGE_WIDTH  // コピー先のX
    , 0                       // コピー先のY
    , 0                       // コピー元のX
    , 0                       // コピー元のY
    , COUNT_IMAGE_WIDTH       // コピー元の幅
    , COUNT_IMAGE_HEIGHT      // コピー元の高さ
  );
}

// 出力
header('Content-type: image/png');
imagepng($image);


/**
 * 整数から画像リストを作成
 *
 * @param integer $number
 * @return array
 */
function makeImageList(int $number){
  $list = [];
  $values = str_split((string)$number);
  for($i=0; $i<count($values); $i++){
    array_push($list, sprintf('image/number%02d_s.png', $values[$i]));
  }
  return($list);
}