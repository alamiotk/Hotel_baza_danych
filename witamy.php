<?php
	session_start();
	if(!isset($_SESSION['udanarejestracja'])){
		header('Location: index.php');
    exit();
	}
  else{
    unset($_SESSION['udanarejestracja']);
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
  Dziękujemy za rejestrację na stronie naszego hotelu!<br /> Możesz już zalogować się na swoje konto i dokonać rezerwacji! :)<br /><br />
  </font></b>

  <font face="fantasy" size="4">
  <a href="index.php">Zaloguj się na swoje konto!</a><br />
  </font>


</body>
</html>
