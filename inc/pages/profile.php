<?php 
if($_SESSION["LoggedIn"]) 
{
?>
	<table>
		<tr>
			<th colspan="3">Profil</th>
		</tr>
		
		<?php
			$data = dibi::query("SELECT * FROM ucty WHERE Name=%s",$_SESSION["Nick"]);
			foreach($data as $profil)
			{
				echo "<tr><th  colspan=\"3\">Avatar</th></tr>";
				
				echo "<tr><td>Nick</td><td>".$profil->Name."</td></tr>";
				echo "<tr><td>Email</td><td>".$profil->Email."</td></tr>";
				echo "<tr><th colspan=\"3\">Změna údajů</th></tr>";
				echo "<tr><form method=\"POST\"><td>Nový email</td><td><input type=\"text\" name=\"newmail\"></td><td><input type=\"submit\" name=\"mailchange\" value=\"Změnit\"></td></form></tr>";
				echo "<tr><form method=\"POST\"><td>Změna hesla</td><td><input type=\"text\" name=\"p1\"></td><td><input type=\"submit\" name=\"passchange\" value=\"Změnit\"></td></form></tr>";
				if(!$profil->PublicMail){
				echo "<tr><form method=\"POST\"><td>Veřejný email</td><td><input type=\"checkbox\" name=\"pblc\"></td><td><input type=\"submit\" name=\"public\" value=\"Změnit\"></td></form></tr>";}else{
				echo "<tr><form method=\"POST\"><td>Veřejný email</td><td><input type=\"checkbox\" name=\"pblc\" checked=\"checked\"></td><td><input type=\"submit\" name=\"public\" value=\"Změnit\"></td></form></tr>";}
				
				
			}
		?>
		
	</table>

<?php
if(@$_POST["mailchange"])
{
	if($_POST["newmail"] != "")
	{
		$pl = array('Email'=>htmlspecialchars($_POST["newmail"]),);
		if(dibi::query("UPDATE ucty SET", $pl, "WHERE Name=%s", $_SESSION["Nick"]))
		{
			echo "Email úspěšně změněn.";
		}else echo "Chyba při změně emailu.";
	}else echo "Nezadal jsi nový email!";
}

if(@$_POST["passchange"])
{

	if($_POST["p1"] != "")
	{
		$newheslo = hash("sha512",$_POST["p1"]);
		$louka = array('Pass'=>$newheslo,);
		if(dibi::query("UPDATE ucty SET", $louka, "WHERE Name=%s", $_SESSION["Nick"]))
		{
			echo "Heslo úspěšně změněno.";
		}else echo "Chyba při změně hesla.";
	}else echo "Nezadal jsi nové heslo!";
}
if(@$_POST["public"])
{
	if($_POST["pblc"] == "on")
	{
		$louka = array('PublicMail'=>1,);
		if(dibi::query("UPDATE ucty SET", $louka, "WHERE Name=%s", $_SESSION["Nick"]))
		{
			echo "Zveřejnění emailu zapnuto!";
		}
	}else{
		$louka = array('PublicMail'=>0,);
		if(dibi::query("UPDATE ucty SET", $louka, "WHERE Name=%s", $_SESSION["Nick"]))
		{
			echo "Zveřejnění emailu vypnuto!";
		}
	}
}

}else{ echo "Nejsi přihlášen. Nemůžeš upravoval svůj profil."; }


?>