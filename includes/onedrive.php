<?php

function OneDrive($key) {
	$links = include 'onedrive_data.txt';
	return '"' . $links[$key] . '" onclick="waitMsg()"';
}

?>