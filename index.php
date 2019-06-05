<?php
	session_start();
	if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)){
		header('Location: baza.php');
		exit();
	}
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Hotel Marin- baza danych</title>

</head>

<body background="pic.jpg" align="center" vertical-align="middle">

<font face="Brush Script MT" size="7">
<br />
Hotel Marin
<br /><br />
</font>
<font face="Courier" size="6"><b>
	Zaloguj się, aby dokonać rezerwacji:<br /><br />
</font></b>
<font face="Courier" size="5"><b>
	<form action="zaloguj.php" method="post">
		Login: <br /><input type="text" name="login" /><br />
		Hasło: <br /><input type="password" name="haslo" /><br /><br />
		<input type="submit" value="Zaloguj się" /><br />
	</form>
</b>
</font>

<?php
	if(isset($_SESSION['blad'])) echo $_SESSION['blad'];

?>
<br /><br />
<font face="cursive" size="5">
Nie masz konta?<br />
</font>
<font face="cursive" size="4">
<a href="rejestracja.php">Zarejestruj się!</a><br />
</font>


</body>
</html>
