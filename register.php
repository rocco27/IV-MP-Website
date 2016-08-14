<form method="POST">
	<table style="text-align:center;">
		<tr>
			<th colspan="3">Registrace</th>
		</tr>
		
		<tr>
			<td>Pøihlašovací jméno :</td>
			<td><input type="text" name="username"></td>
		</tr>
		<tr>
			<td>Heslo :</td>
			<td><input type="password" name="pass"></td>
		</tr>
		<tr>
			<td>Potvrzení hesla :</td>
			<td><input type="password" name="pass2"></td>
		</tr>
		<tr>
			<td>Email :</td>
			<td><input type="text" name="mail"></td>
		</tr>
		<tr>
			<td>Potvrzení emailu :</td>
			<td><input type="text" name="mail2"></td>
		</tr>
		<tr>
			<td colspan="3"><input type="submit" name="odeslat" value="Odeslat">
		</tr>
	</table>
</form>
<?php

if(@$_POST["odeslat"])
{
	if(isset($_POST["username"]) or isset($_POST["pass"]) or isset($_POST["pass2"]) or isset($_POST["mail"]) or isset($_POST["mail2"]))
	{
		if($_POST["pass"] == $_POST["pass2"] and $_POST["mail"] == $_POST["mail2"])
		{
			Register(htmlspecialchars($_POST["username"]),$_POST["pass"],$_POST["mail"]);
		}
	}else{
	
	}
}

function Register($username,$pass,$mail)
{
	$hashstring = $username.$pass.$mail;
	$hashstring = md5($hashstring);
	$message = "Aktivujte svùj úèet : <a href='http://127.0.0.1/activate.php?n=".$username."&c=".$hashstring ."'>ZDE</a>";
	$headers  = "From: My site<noreply@example.com>\r\n"; 
    $headers .= "Reply-To: info@example.com\r\n"; 
    $headers .= "Return-Path: info@example.com\r\n"; 
    $headers .= "X-Mailer: Drupal\n"; 
    $headers .= 'MIME-Version: 1.0' . "\n"; 
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
	if(mail($mail, "Aktivace úètu", $message,$headers))
	{
		echo "Aktivaèní email byl odeslán na uvedenou adresu.";
	}else{
		echo "Aktivaèní email se nepodaøilo odeslat.\nKontaktujte zprávce webu.";
	}
}
?>








