<?php

$fname = './uid.txt';

//open or create
$fp = fopen($fname, "c+");
if (!$fp) {
	echo $fname." creation error!";
	die();
}
//lock
$lock = flock($fp, LOCK_EX);
if (!$lock) {
	echo $fname." locking error!";
	die();
}

//read
$txt = fgets($fp);
$val = (int)$txt;
if ($val < 200000) $val=200000;

//modify
$val = 100*floor($val/100)+100;

//checksum
$tmp=$val;
$digit1 = floor($tmp/100000); $tmp -= $digit1*100000;
$digit2 = floor($tmp/10000); $tmp -= $digit2*10000;
$digit3 = floor($tmp/1000); $tmp -= $digit3*1000;
$digit4 = floor($tmp/100);
$csum = 1*$digit1 + 2*$digit2 + 3*$digit3 + 4*$digit4;
$val += $csum;

//write back
ftruncate($fp,0);
rewind($fp);
if (fwrite($fp,$val)!=6) {
	echo $fname." writing error!";
	die();
}

//unlock, close
flock($fp,LOCK_UN);
fclose($fp);

echo $val;

?>
