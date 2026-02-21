<?php

if (!isset($_REQUEST['to']) || !isset($_REQUEST['msg']) || !isset($_REQUEST['name'])) {
	echo 'ERROR: hiányzó paraméter!';
	exit();
}
$to=$_REQUEST['to'];
$msg=$_REQUEST['msg'];
$name=$_REQUEST['name'];
$type=(isset($_REQUEST['type']) ? $_REQUEST['type'] : 0);

//type: 0=reg, 1=lostpsw, 2=newemail, 3=renuser, 4=deluser, 5=...

if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
	echo 'ERROR: hibás email!';
	exit();
}
if (strlen($msg)!=6) {
	echo 'ERROR: hibás kód!';
	exit();
}
if (strlen($name)==0) {
	echo 'ERROR: hibás név!';
	exit();
}

$message = "Tisztelt " . $name . "! <br /><br />";

if ($type==0) {
	$subject='Diatár regisztrációs kód';
	$message .= "Ön a Diatár programban internetes vetítésre kezdeményezett regisztrációt.<br />";
	$message .= "Ezt az egyszeri kódot kell beírnia:<br />";
	$message .= "<h1> " . $msg . " </h1><br />";
	$message .= "Köszönjük a regisztrációját! Munkáján legyen a Jóisten áldása!<br />";
} else if ($type==1) {
	$subject='Diatár jelszóváltoztatás';
	$message .= "Ön a Diatár programban internetes vetítésnél új jelszót szeretne beállítani.<br />";
	$message .= "Ezt az egyszeri kódot kell beírnia:<br />";
	$message .= "<h1> " . $msg . " </h1><br />";
	$message .= "Ha nem Ön kezdeményezte a jelszóváltást, ne tegyen semmit, marad a régi.<br />";
} else if ($type==2) {
	$subject='Diatár emailváltoztatás';
	$message .= "Ön a Diatár programban internetes vetítésnél új email címet szeretne beállítani.<br />";
	$message .= "Ezt az egyszeri kódot kell beírnia:<br />";
	$message .= "<h1> " . $msg . " </h1><br />";
	$message .= "Ha nem Ön kezdeményezte az email váltást, ne tegyen semmit, marad a régi.<br />";
} else if ($type==3) {
	$subject='Diatár felhasználónév változtatás';
	$message .= "Ön a Diatár programban internetes vetítésnél új felhasználónevet szeretne beállítani.<br />";
	$message .= "Ezt az egyszeri kódot kell beírnia:<br />";
	$message .= "<h1> " . $msg . " </h1><br />";
	$message .= "Ha nem Ön kezdeményezte a névváltást, ne tegyen semmit, marad a régi.<br />";
} else if ($type==4) {
	$subject='Diatár felhasználó törlés';
	$message .= "Ön a Diatár programban internetes vetítésnél törölni kívánja a felhasználót.<br />";
	$message .= "Vigyázat! Ez végleges - ha mégis szüksége van a felhasználóra, újra létre kell hoznia!<br />";
	$message .= "Ezt az egyszeri kódot kell beírnia:<br />";
	$message .= "<h1> " . $msg . " </h1><br />";
	$message .= "Ha nem Ön kezdeményezte a törlést, ne tegyen semmit, minden marad a régiben.<br />";
}

$message .= "<br />Üdvözli a Diatár csapata.";


$headers = 'From: "Diatar" <noreply@diatar.eu>' ."\r\n";
//$headers .= "Reply-To: <" . $_REQUEST['email'] . ">\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

if (mail($to,$subject,$message,$headers)) {
	echo 'SENT';
} else {
	echo 'ERROR: üzenetküldés sikertelen!';
}

?>
