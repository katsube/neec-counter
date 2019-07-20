<?php
/**
 * ファイル監視
 *
 * @author M.Katsube <katsubemakito@gmail.com>
 * @version 1.0.0
 */

//--------------------------------------------
// 定数定義
//--------------------------------------------
define('DATA_FILE', 'data/counter.txt');

//--------------------------------------------
// ファイル監視
//--------------------------------------------
$befor = "";
while ( true ){
  $buff = file_get_contents(DATA_FILE);  // ファイルからデータ取得
  $buff = rtrim($buff);                  // 改行や不要な余白を削除

  // 前回取って来たものと違えば表示
  if ( $befor !== $buff ){
    echo "$buff\n";  // 表示
    $befor = $buff;  // 入れ替え
  }

  // 20msec 待機
  usleep(20);
}
