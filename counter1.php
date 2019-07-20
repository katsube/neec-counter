<?php
require_once('AccessCounter.php');

//-----------------------------------
// カウンターの値を取得
//-----------------------------------
try{
	$counter = new AccessCounter();
	$number  = $counter->getCount();	// カウンターの値を取得
	$counter->addCount();				// カウンターを加算
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
<?= $number ?>
</body>
</html>