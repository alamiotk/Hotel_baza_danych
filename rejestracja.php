
  <br />

<?php
	session_start();
  if(isset($_POST['pesel'])){
    $wszystko_OK=true;

    $pesel=$_POST['pesel'];
    $imie=$_POST['imie'];
    $nazwisko=$_POST['nazwisko'];
    $adres1=$_POST['adres1'];
    $adres2=$_POST['adres2'];
    $telefon=$_POST['telefon'];
    $nr_dowodu=$_POST['nr_dowodu'];
    $login=$_POST['login'];
    $haslo1=$_POST['haslo1'];
    $haslo2=$_POST['haslo2'];


    if(strlen($pesel)!=11){
      $wszystko_OK=false;
      $_SESSION['e_pesel']="Pesel musi posiadać 11 cyfr";
    }
    if(strlen($telefon)!=9){
      $wszystko_OK=false;
      $_SESSION['e_telefon']="Nr telefonu musi posiadać 9 cyfr";
    }

    if(strlen($nr_dowodu)!=9){
      $wszystko_OK=false;
      $_SESSION['e_nr_dowodu']="Nr dowodu musi posiadać 9 znaków";
    }

    if((strlen($haslo1)<3) || (strlen($haslo1)>12)){
      $wszystko_OK=false;
      $_SESSION['e_haslo1']="Hasło musi posiadać od 3 do 12 znaków";
    }

    if($haslo1 != $haslo2){
      $wszystko_OK=false;
      $_SESSION['e_haslo2']="Podane hasła nie są identyczne!";
    }

    if(!isset($_POST['regulamin'])){
      $wszystko_OK=false;
      $_SESSION['e_regulamin']="Zaakceptuj regulamin!";
    }

    $sekret = "6Ld9iKUUAAAAAA5NV-gTDrG_nTfWmpgAenyaVaIa";

    $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
    $odpowiedz = json_decode($sprawdz);

    if($odpowiedz->success==false){
      $wszystko_OK=false;
      $_SESSION['e_bot']="Potwierdź, że nie jesteś botem!";
    }

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try{
      $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
      if ($polaczenie->connect_errno!=0){
    		throw new Exception(mysqli_connect_errno());
    	}
      else{
        $rezultat = $polaczenie->query("SELECT pesel FROM Gosc WHERE login='$login'");

        if(!$rezultat) throw new Exception($polaczenie->error);

        $ile_log = $rezultat->num_rows;
        if($ile_log>0){
          $wszystko_OK=false;
          $_SESSION['e_login']="Istnieje już taki login! Wybierz inny ;)";
        }

        if($wszystko_OK==true){
          if($polaczenie->query("INSERT INTO Gosc VALUES('$pesel', '$imie', '$nazwisko', '$adres1', '$adres2', '$telefon', '$nr_dowodu', '$login', '$haslo1' )")){
            $_SESSION['udanarejestracja']=true;
            header('Location: witamy.php');
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
	<title>Hotel Marin- zarejestruj się!</title>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <style>
    .error{
      color:red;
      margin-top: 10px;
      margin-bottom:10px;
    }
  </style>

</head>

<body background="pic.jpg" align="center" vertical-align="middle">
<font face="Courier" size="5"><b>
  <form method="post">
    Pesel: <br /><input type="text" name="pesel" /><br /><br />
    <font face="Courier" size="4"><b>
    <?php
    if(isset($_SESSION['e_pesel'])){
      echo '<div class="error">'.$_SESSION['e_pesel'].'</div>';
      unset($_SESSION['e_pesel']);
    }
    ?>
  </font></b>
    Imię: <br /><input type="text" name="imie" /><br /><br />
    Nazwisko: <br /><input type="text" name="nazwisko" /><br /><br />
    Miasto: <br /><input type="text" name="adres1" /><br /><br />
    Ulica i numer domu: <br /><input type="text" name="adres2" /><br /><br />
    Numer telefonu: <br /><input type="text" name="telefon" /><br /><br />
    <font face="Courier" size="4"><b>
    <?php
    if(isset($_SESSION['e_telefon'])){
      echo '<div class="error">'.$_SESSION['e_telefon'].'</div>';
      unset($_SESSION['e_telefon']);
    }
    ?>
    </font></b>
    Numer dowodu: <br /><input type="text" name="nr_dowodu" /><br /><br />
    <font face="Courier" size="4"><b>
    <?php
    if(isset($_SESSION['e_nr_dowodu'])){
      echo '<div class="error">'.$_SESSION['e_nr_dowodu'].'</div>';
      unset($_SESSION['e_nr_dowodu']);
    }
    ?>
    </font></b>
    Login: <br /><input type="text" name="login" /><br /><br />
    <font face="Courier" size="4"><b>
    <?php
    if(isset($_SESSION['e_login'])){
      echo '<div class="error">'.$_SESSION['e_login'].'</div>';
      unset($_SESSION['e_login']);
    }
    ?>
    </font></b>
    Hasło: <br /><input type="password" name="haslo1" /><br /><br />
    <font face="Courier" size="4"><b>
    <?php
    if(isset($_SESSION['e_haslo1'])){
      echo '<div class="error">'.$_SESSION['e_haslo1'].'</div>';
      unset($_SESSION['e_haslo1']);
    }
    ?>
    </font></b>
    Powtórz hasło: <br /><input type="password" name="haslo2" /><br /><br />
    <font face="Courier" size="4"><b>
    <?php
    if(isset($_SESSION['e_haslo2'])){
      echo '<div class="error">'.$_SESSION['e_haslo2'].'</div>';
      unset($_SESSION['e_haslo2']);
    }
    ?>
    </font></b>
    <br />
  </font></b>
    <font face="Courier" size="4"><b>
    <label>
      <input type="checkbox" name="regulamin" />Akceptuję regulamin
    </label>
    <?php
    if(isset($_SESSION['e_regulamin'])){
      echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
      unset($_SESSION['e_regulamin']);
    }
    ?>
    <br /><br />
    <div align="center" class="g-recaptcha" data-sitekey="6Ld9iKUUAAAAAMrsx_yRk8uTzpZj2B-BNFJcI-WA"></div>
    <?php
    if(isset($_SESSION['e_bot'])){
      echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
      unset($_SESSION['e_bot']);
    }
    ?>
    <br />
    <input type="submit" value="Zarejestruj się" />


  </form>

</font></b>

</body>
</html>
