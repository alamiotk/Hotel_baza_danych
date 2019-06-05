<?php
	session_start();
	if(!isset($_SESSION['zalogowany'])){
		header('Location: index.php');
		exit();
	}

	if(isset($_POST['id_kategorii'])){
    $wszystko_OK=true;

		$login = $_SESSION['login'];
		$data_zamowienia = $_POST['data_zamowienia'];
    $id_kategorii = $_POST['id_kategorii'];
    $zamawia_od = $_POST['zamawia_od'];
    $zamawia_do = $_POST['zamawia_do'];

		if(($id_kategorii<1) || ($id_kategorii>6)){
				$wszystko_OK=false;
				$_SESSION['e_id_kategorii']="Musisz wybrać jedną z dostępnych kategorii: cyfra od 1-6";
		}

		$dzis = date('Y-m-d');

		if($data_zamowienia != $dzis){
			$wszystko_OK=false;
			$_SESSION['e_data_zamowienia']="Musisz wybrać dzisiejszą datę";
		}

		if($zamawia_od < $dzis){
			$wszystko_OK=false;
			$_SESSION['e_zamawia_od']="Musisz wybrać późniejszą date";
		}
		if($zamawia_do <= $dzis){
			$wszystko_OK=false;
			$_SESSION['e_zamawia_do']="Musisz wybrać dzisiejszą datę";
		}

	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);

    try{
      $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			$zapytanie = "SELECT pesel FROM Gosc WHERE login='$login'";
		 	$rezultat = $polaczenie->query($zapytanie);
			while($wiersz = $rezultat->fetch_assoc()){
				foreach($wiersz as $pesel);
			}

      if ($polaczenie->connect_errno!=0){
    		throw new Exception(mysqli_connect_errno());
    	}
			else{
	      if($wszystko_OK==true){
	        if($polaczenie->query("INSERT INTO Rezerwacja_zamowiona VALUES('$data_zamowienia', '$pesel', '$id_kategorii', '$zamawia_od', '$zamawia_do')")){
	          $_SESSION['udanarezerwacja']=true;
	          header('Location: rezerwacja.php');
	        }
	        else{
	           throw new Exception($polaczenie->error);
	        }
				}
        $polaczenie->close();
    	}
  	}
    catch(Exception $e){
      echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
  	}

	}

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Hotel Marin- baza danych</title>
	<style>
    .error{
      color:red;
      margin-top: 10px;
      margin-bottom:10px;
    }
  </style>
</head>

<body background="pic.jpg" align="center">
<font face="FreeMono" size="4">
<?php

	echo"<p>Witaj ".$_SESSION['login'].'![<a href="logout.php">Wyloguj się!</a>]</p>';
?>

<font face="Brush Script MT" size="7">
Hotel Marin<br />
</font>

</font>
<font face="Luminary" size="6">
KATEGORIE POKOI:<br /><br />
</font>
<font face="Luminary" size="4">
<table width="1200" align="center" border="1" bordercolor="#d5d5d5"  cellpadding="0" cellspacing="0">
<tr>
	<?php

require_once "connect.php";
$polaczenie = mysqli_connect($host, $db_user, $db_password, $db_name);
mysqli_query($polaczenie, "SET CHARSET utf8");
mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
mysqli_select_db($polaczenie, $db_name);

$zapytanie = "SELECT * FROM kategorie";
$rezultat = mysqli_query($polaczenie, $zapytanie);
				$ile = mysqli_num_rows($rezultat);

				if ($ile>=1)
{
	echo'<td width="50" align="center" bgcolor="#999999"><b>ID kategorii</b></td>
	<td width="50" align="center" bgcolor="#999999"><b>Nazwa kategorii</b></td>
	<td width="50" align="center" bgcolor="#999999"><b>Cena</b></td>
	<td width="50" align="center" bgcolor="#999999"><b>Liczba miejsc</b></td>
	<td width="50" align="center" bgcolor="#999999"><b>Opis</b></td>
	</tr><tr>';
}

for ($i = 1; $i <= $ile; $i++)
{
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
?>
</tr>
</table>
</font>
<br /><br />
<font face="Courier" size="5"><b>
<a href="moje_rezerwacje.php">ZOBACZ HISTORIĘ SWOICH REZERWACJI</a>
</font></b>
 <br /><br />
<font face="Luminary" size="6">
 Dodaj rezerwację:
</font>
<br /><br /><br />
<font face="Courier" size="5"><b>
<form method="post">
		Data zamówienia: <br /><input type="date" name="data_zamowienia" /><br /><br />
		<font face="Courier" size="4"><b>
		<?php
		if(isset($_SESSION['e_data_zamowienia'])){
			echo '<div class="error">'.$_SESSION['e_data_zamowienia'].'</div>';
			unset($_SESSION['e_data_zamowienia']);
		}
		?>
		</font></b>

		ID kategorii: <br /><input type="text" name="id_kategorii" /><br /><br />
		<font face="Courier" size="4"><b>
		<?php
    if(isset($_SESSION['e_id_kategorii'])){
      echo '<div class="error">'.$_SESSION['e_id_kategorii'].'</div>';
      unset($_SESSION['e_id_kategorii']);
    }
    ?>
		</font></b>
		Zamawiam od: <br /><input type="date" name="zamawia_od" /><br /><br />
		<font face="Courier" size="4"><b>
		<?php
		if(isset($_SESSION['e_zamawia_od'])){
			echo '<div class="error">'.$_SESSION['e_zamawia_od'].'</div>';
			unset($_SESSION['e_zamawia_od']);
		}
		?>
		</font></b>
		Zamawiam do: <br /><input type="date" name="zamawia_do" /><br /><br />
		<font face="Courier" size="4"><b>
		<?php
		if(isset($_SESSION['e_zamawia_do'])){
			echo '<div class="error">'.$_SESSION['e_zamawia_do'].'</div>';
			unset($_SESSION['e_zamawia_do']);
		}
		?>
		</font></b>
		<input type="submit" name="dodaj" value="Dodaj" />
		<br /><br />

	</form>
</b>
</font>
</body>
</html>
