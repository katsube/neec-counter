<?php
/**
 * アクセスカウンター クラス
 *
 * @version 1.0.0
 * @author M.Katsube <katsubemakito@gmail.com>
 */
class AccessCounter{
  private $file  = 'data/counter.txt';  // データファイル
  private $fp    = null;  // ファイルポインタ
  private $error = null;  // エラーメッセージ

  //エラーコードの一覧
  private $error_cd = [
    'E001' => 'Data File is not file',     // ファイルが存在しないか、ファイルでｈない
    'E002' => 'Data File can not read',    // ファイルが読み込めない
    'E003' => 'Data File can not write',   // ファイルに書き込めない
    'E004' => 'Invalid open mode'          // 不正なモードでファイルを開こうとした
  ];

  /**
   * コンストラクタ
   *
   * @param string [$file] データファイルのパス
   * @return void
   * @access public
   */
  function __construct(string $file=null){
    if( $file !== null ){
      $this->file = $file;
    }

    // ファイルを開く
    $this->fp = $this->_openDataFile($this->file, 'a+');
    if( $this->fp === false ){
      $message = sprintf('[%s] %s (%s)',$this->error['cd'], $this->error['message'], $this->error['target']);
      throw new Exception($message);
    }

    // ロックする(排他制御)
    flock($this->fp, LOCK_EX);
  }

  /**
   * デストラクタ
   *
   * @return void
   * @access public
   */
  function __destruct(){
    // ロックを解除する
    flock($this->fp, LOCK_UN);

    // ファイルを閉じる
    fclose($this->fp);
  }

  /**
   * 現在のカウンター値を返却
   *
   * @return integer
   * @access public
   */
  function getCount(){
    // ファイルポインタを最初に戻す
    rewind($this->fp);

    // 値を返却 (整数型にキャスト)
    return( (integer) fgets($this->fp) );
  }

  /**
   * カウンター値を加算
   *
   * @param integer [$value] カウンター値を指定
   * @return void
   * @access public
   */
  function addCount( int $value=null ){
    // 現在の値を取得
    if($value === null){
      $value = $this->getCount();
    }

    // ファイルを真っ白にして書き込む
    ftruncate($this->fp, 0);      // ファイルサイズをゼロに
    rewind($this->fp);            // ファイルポインタを先頭に戻す
    fwrite($this->fp, $value+1);  // 書き込む
  }

  /**
   * データファイルを開く
   *
   * @param string $file       ファイルパス
   * @param string [$mode="r"] ファイルを開くモード
   * @return resource|false
   * @access private
   */
  private function _openDataFile( string $file, string $mode="r" ){
    // ファイルかチェック
    if( ! is_file($file) ){
      $this->_setError('E001');
      return(false);
    }
    // ファイルが読み取り可能かチェック
    if( ! is_readable($file) ){
      $this->_setError('E002');
      return(false);
    }
    // ファイルが書き込み可能かチェック
    if( ! is_writable($file) ){
      $this->_setError('E003');
      return(false);
    }
    // ファイルを開くモードが適切かチェック
    if( ! in_array($mode, ['r', 'r+', 'w', 'w+', 'a', 'a+']) ){
      $this->_setError('E004', $mode);
      return(false);
    }

    return(
      fopen($file, $mode)
    );
  }

  /**
   * エラーメッセージをセット
   *
   * @param string $cd        エラーコード
   * @param string [$memo]    記録しておきたいメモ
   * @param string [$target]  ファイルのパス
   * @return void
   * @access private
   */
  private function _setError(string $cd, string $memo=null, string $target=null){
    $this->error = [
        'cd'      => $cd
      , 'message' => $this->error_cd[$cd]
      , 'memo'    => $memo
      , 'target'  => ($target === null)?  $this->file:$target
    ];
  }
}