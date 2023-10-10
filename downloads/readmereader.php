<?php
echo '<html><head><meta http-equiv=Content-Type content="text/html; charset=utf-8"></head>';
echo '<body lang=HU><div>';

$findex=(isset($_GET["file"]) ? $_GET["file"] : 1);
$fname="README.Debian";
if ($findex==2) $fname="README.LinuxTarGz";

$handle=fopen($fname,"r");
if ($handle) {
	while ($line=fgets($handle)) {
		echo $line."<br/>\n";
	}
} else {
	echo "Error opening README.Debian";
}
fclose($handle);

echo '</div></body></html>';
?>
