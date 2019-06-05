<?php
	session_start();

	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

	if ($polaczenie->connect_errno!=0){
		echo "Error:".$polaczenie->connect_errno;
	}
	else {
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];

		$sql = "SELECT * FROM Gosc WHERE login='$login' AND haslo='$haslo'";

		if ($rezultat = @$polaczenie->query($sql)){
			$ilu_uzytk = $rezultat->num_rows;

			if($ilu_uzytk > 0){
				$_SESSION['zalogowany'] = true;

				$wiersz = $rezultat->fetch_assoc();
				$_SESSION['login'] = $wiersz['login'];


				unset($_SESSION['blad']);
				$rezultat->free_result();
				header('Location: baza.php');
			}
			else {
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
			}
		}

		$polaczenie->close();
	}

	$login = $_POST['login'];
	$haslo = $_POST['haslo'];


 ?>
