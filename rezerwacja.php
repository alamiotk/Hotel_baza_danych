<?php
	session_start();
	if(!isset($_SESSION['udanarezerwacja'])){
		header('Location: baza.php');
    exit();
	}
  else{
    unset($_SESSION['udanarezerwacja']);
  }
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Hotel Marin</title>

</head>

<body background="pic.jpg" align="center" vertical-align="middle">

  <font face="Brush Script MT" size="7">
  <br />
  Hotel Marin
  <br /><br />
  </font>
  <font face="Courier" size="6"><b>
  Dziękujemy za dokonanie rezerwacji.<br /> Poinformujemy czy może być ona zrealizowana :)<br /><br />
  <font face="Courier" size="5"><b>
  <a href="baza.php">Wróć do strony głównej!</a><br />
  </font></b>

</body>
</html>
