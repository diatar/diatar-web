<?php
	//DTX fajlok listaja

	error_reporting(E_ERROR | E_PARSE);

	header('Content-Type: text/plain');

	$files = scandir('.');
	foreach($files as $fname) {
		if (strtolower(substr($fname,-4)) != '.dtx') continue;
		$f = fopen($fname,'r');
		if (!$f) {
			echo "Error opening '$fname' !!!\n";
			continue;
		}
		$longname=$fname;
		$grpname="";
		$order="0";
		while (!feof($f)) {
			$txt=substr(fgets($f),0,-2);
			if ($txt!="") {
				$ch=$txt[0];
				if ($ch==='>' || $ch==='/') break;
				else if ($ch==='N') $longname=substr($txt,1);
				else if ($ch==='C') $grpname=substr($txt,1);
				else if ($ch==='S') $order=substr($txt,1);
			}
		}
		fclose($f);
		echo $fname .','. filesize($fname) .','. date('YmdHis',filemtime($fname))
			.',"'. $grpname .'",'. $order .',"'. $longname .'"'."\n";
	}

?>
