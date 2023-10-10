<?php
	session_start();
	if(!isset($_GET['lap'])) {
		header('location:hiba.htm');
		exit();
	}
	$lap=$_GET['lap'];
	if(isset($_SESSION['bent'])) {
    header('location:vedett_'.$lap.'.htm');
    exit();
	}
	if (isset($_POST['jelszo'])) {
    if ($_POST['jelszo']=='ApCsel17') {
      $_SESSION['bent']=1;
      header('location:bejel.php?lap='.$lap);
      exit();
    } else {
      $hiba="Hibás jelszó!";
    }
	}

	include 'bejelszoveg.htm';
	
?>
