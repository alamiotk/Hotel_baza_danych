<?php
	error_reporting(E_ALL ^ E_NOTICE);
	session_start();
  if(!isset($_SESSION['zalogowany'])){
  header('Location: index.php');
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

<body background="pic.jpg" align="center">

<font face="Brush Script MT" size="7">
Hotel Marin<br /><br />
</font>

</font>
<font face="Luminary" size="6">
TWOJE REZERWACJE:<br /><br />
</font>
<font face="Luminary" size="4">
<table width="1200" align="center" border="1" bordercolor="#d5d5d5"  cellpadding="0" cellspacing="0">
<tr>

<?php

  require_once "connect.php";
  mysqli_report(MYSQLI_REPORT_STRICT);
  try{
    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
    $login = $_SESSION['login'];
    $zap = "SELECT pesel FROM Gosc WHERE login='$login'";
    $rez = $polaczenie->query($zap);
    while($wiersz = $rez->fetch_assoc()){
  		foreach($wiersz as $pesel){
      }
  	}

  	$zapytanie = "SELECT * FROM Rezerwacja_zamowiona WHERE pesel='$pesel'";
   	$rezultat = $polaczenie->query($zapytanie);
      $ile = mysqli_num_rows($rezultat);

        if ($ile>=1){
          	echo'<td width="50" align="center" bgcolor="#999999"><b>Data zamówienia</b></td>
          	<td width="50" align="center" bgcolor="#999999"><b>Pesel</b></td>
          	<td width="50" align="center" bgcolor="#999999"><b>ID kategorii</b></td>
          	<td width="50" align="center" bgcolor="#999999"><b>Zamówione od</b></td>
          	<td width="50" align="center" bgcolor="#999999"><b>Zamówione do</b></td>
          	</tr><tr>';
        }

        for ($i = 1; $i <= $ile; $i++){
        	$row = mysqli_fetch_row($rezultat);
        	$a1 = $row[0];
        	$a2 = $row[1];
        	$a3 = $row[2];
        	$a4 = $row[3];
        	$a5 = $row[4];

        	echo '<td width="50" align="center" bgcolor="e5e5e5">'.$a1.'</td>
        	<td width="100" align="center" bgcolor="e5e5e5">'.$a2.'</td>
        	<td width="100" align="center" bgcolor="e5e5e5">'.$a3.'</td>
        	<td width="100" align="center" bgcolor="e5e5e5">'.$a4.'</td>
        	<td width="100" align="center" bgcolor="e5e5e5">'.$a5.'</td>
        	</tr><tr>';
        }
			}
			catch(Exception $e){
				echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			}
?>
</tr>
</table>
<br /><br />

<font face="Luminary" size="6">
TWOJE PRZYDZIELONE REZERWACJE:<br /><br />
</font>
<table width="1200" align="center" border="1" bordercolor="#d5d5d5"  cellpadding="0" cellspacing="0">
<tr>

<?php

			require_once "connect.php";
			mysqli_report(MYSQLI_REPORT_STRICT);
			try{
				$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
				$login = $_SESSION['login'];
				$zap = "SELECT pesel FROM Gosc WHERE login='$login'";
				$rez = $polaczenie->query($zap);
				while($wiersz = $rez->fetch_assoc()){
					foreach($wiersz as $pesel){
					}
				}

				$zs = "SELECT id_kategorii FROM Rezerwacja_zamowiona  WHERE pesel='$pesel'";
				$rezp = $polaczenie->query($zs);
				while($wiersz = $rezp->fetch_assoc()){
					foreach($wiersz as $id_kategorii){
					}
				}
				$zs = "SELECT nr_pokoju FROM Pokoj  WHERE id_kategorii='$id_kategorii'";
				$rezp = $polaczenie->query($zs);
				while($wiersz = $rezp->fetch_assoc()){
					foreach($wiersz as $nr_pokoju){
					}
				}
				$zs = "SELECT data_zamowienia FROM Rezerwacja_zamowiona  WHERE pesel='$pesel'";
				$rezp = $polaczenie->query($zs);
				while($wiersz = $rezp->fetch_assoc()){
					foreach($wiersz as $data_zamowienia){
					}
				}
				$po = "SELECT data_od FROM Rezerwacja_przydzielona";
				$rezpo = $polaczenie->query($po);
				while($wiersz = $rezpo->fetch_assoc()){
					foreach($wiersz as $data_od){
					}
				}
				$po = "SELECT data_do FROM Rezerwacja_przydzielona";
				$rezpo = $polaczenie->query($po);
				while($wiersz = $rezpo->fetch_assoc()){
					foreach($wiersz as $data_do){
					}
				}
				$po = "SELECT zamawia_od FROM Rezerwacja_zamowiona WHERE data_zamowienia='$data_zamowienia'";
				$rezpo = $polaczenie->query($po);
				while($wiersz = $rezpo->fetch_assoc()){
					foreach($wiersz as $zamawia_od){
					}
				}
				$pos = "SELECT zamawia_do FROM Rezerwacja_zamowiona  WHERE data_zamowienia='$data_zamowienia'";
				$rezpos = $polaczenie->query($pos);
				while($wiersz = $rezpos->fetch_assoc()){
					foreach($wiersz as $zamawia_do){
					}
				}
				$pok = "SELECT id_kategorii FROM Rezerwacja_zamowiona WHERE (data_zamowienia='$data_zamowienia' AND pesel='$pesel')";
				$r = $polaczenie->query($pos);
				while($wiersz = $r->fetch_assoc()){
					foreach($wiersz as $id_kategorii2){
					}
				}


			//	$dodaj = $_SESSION['dodaj'];
			$polaczenie->query("SELECT * FROM Rezerwacja_przydzielona");
			$z = "SELECT * FROM Rezerwacja_zamowiona, Rezerwacja_przydzielona WHERE ('$zamawia_od' >= data_od <= AND '$zamawia_od' <= data_do)";
		  $z2 = "SELECT * FROM Rezerwacja_zamowiona, Rezerwacja_przydzielona WHERE ('$zamawia_do' >= data_od AND '$zamawia_do' <= data_do)";

			$rezultat4 = $polaczenie->query($z);
		  $ile4 = @mysqli_num_rows($rezultat4);
			$rezultat3 = $polaczenie->query($z2);
	   	$ile3 = @mysqli_num_rows($rezultat3);
			$dzis = date("Y-m-d");
			$dostep2 = "SELECT data_zamowienia FROM Rezerwacja_zamowiona WHERE (pesel = '$pesel' AND data_zamowienia = '$dzis')";
			$dr = $polaczenie->query($dostep2);
			$ile5 = @mysqli_num_rows($dr);
			if($ile5>=1){
		    if (($ile4>=1) || ($ile3>=1)){

				//	$dostep = "SELECT nr_pokoju FROM Pokoj WHERE id_kategorii = '$id_kategorii2'";



					//$ile10 = @mysqli_num_rows($dr);
					// while($wiersz = $dr->fetch_assoc()){
					// 	foreach($wiersz as $pokoj){
					//
					// 		$dostep2 = "SELECT nr_pokoju FROM Rezerwacja_przydzielona WHERE (nr_pokoju='$pokoj' AND pesel = '$pesel')";
					// 		// id_kategorii = '$id_kategorii'";
					// 		$drs = $polaczenie->query($dostep2);
					// 		$ile5 = @mysqli_num_rows($drs);
					// 		if($ile5>=1){
								$polaczenie->query("INSERT INTO Rezerwacja_przydzielona VALUES('$zamawia_od', '$pesel', 'NIEDOSTĘPNY', '$zamawia_do')");
							// }
							// else{
							// 	$polaczenie->query("INSERT INTO Rezerwacja_przydzielona VALUES('$zamawia_od', '$pesel', '$nr_pokoju', '$zamawia_do')");
							// }
					// 			// if($dr){
					// 	}
					// }
							// 	//$dostep2 = "SELECT nr_pokoju, id_kategorii FROM Pokoj"
								//
								// }
								// else{
								// }
				}
		    else{
						$polaczenie->query("INSERT INTO Rezerwacja_przydzielona VALUES('$zamawia_od', '$pesel', '$nr_pokoju', '$zamawia_do')");
				}
			}



				$zapytanie2 = "SELECT * FROM Rezerwacja_przydzielona WHERE pesel='$pesel'";
				$rezultat2 = $polaczenie->query($zapytanie2);
					$ile2 = mysqli_num_rows($rezultat2);

						if ($ile2>=1){
								echo'<td width="50" align="center" bgcolor="#999999"><b>Data od</b></td>
								<td width="50" align="center" bgcolor="#999999"><b>Pesel</b></td>
								<td width="50" align="center" bgcolor="#999999"><b>Nr pokoju</b></td>
								<td width="50" align="center" bgcolor="#999999"><b>Data do</b></td>
								</tr><tr>';
						}

						for ($i = 1; $i <= $ile2; $i++){
							$row = mysqli_fetch_row($rezultat2);
							$a1 = $row[0];
							$a2 = $row[1];
							$a3 = $row[2];
							$a4 = $row[3];

							echo '<td width="50" align="center" bgcolor="e5e5e5">'.$a1.'</td>
							<td width="100" align="center" bgcolor="e5e5e5">'.$a2.'</td>
							<td width="100" align="center" bgcolor="e5e5e5">'.$a3.'</td>
							<td width="100" align="center" bgcolor="e5e5e5">'.$a4.'</td>
							</tr><tr>';
						}
      $polaczenie->close();
    }
    catch(Exception $e){
      echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
  	}

  ?>
</tr>
</table>
</font></b>
<font face="Courier" size="5"><b>
<br /><br />
<a href="baza.php">WRÓĆ DO STRONY GŁÓWNEJ!</a>
</font></b>
</body>
</html>
