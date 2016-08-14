<?php if(!$_SESSION["LoggedIn"]) { ?>
<form method="POST">
<table>
	<tr>
		<td>
			<label for="name"><b>Nick</b></label>
		</td>
		<td>
			<input type="text" name="name">
		</td>
	</tr>
	<tr>
		<td>
			<label for="pass"><b>Heslo</b></label>
		</td>
		<td>
			<input type="password" name="pass">
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" class="frm" name="login" value="Přihlásit"></td>
	</tr>
</table>
</form>
<?php
	if(@$_POST["login"])
	{
		if($_POST["name"] != "")
		{
			$data = dibi::query("SELECT * FROM ucty WHERE Name=%s",htmlspecialchars($_POST["name"]));
			$pocet = count($data);
			if($pocet == 1)
			{
				if($_POST["pass"] != "")
				{
					$hashed_pw = hash("sha512",$_POST["pass"]);
					$heslo = dibi::fetchSingle("SELECT Pass FROM ucty WHERE Name=%s",htmlspecialchars($_POST["name"]));
			
					if($hashed_pw == $heslo)
					{
						$data = dibi::fetchAll("SELECT * FROM ucty WHERE Name=%s",htmlspecialchars($_POST["name"]));
						foreach($data as $info)
						{
							session_start();
							$_SESSION["LoggedIn"] = 1;
							$_SESSION["Nick"] = htmlspecialchars($_POST["name"]);
							$_SESSION["Admin"] = $info->Admin;
							$pole = array('Online'=>1,'LastDate'=>time(),'LasIp'=>$_SERVER["REMOTE_ADDR"],);
							dibi::query("UPDATE ucty SET", $pole, "WHERE Name=%s", htmlspecialchars($_POST["name"]));
							echo "Byl jsi úspěšně přihlášen. Přejdi a <a href='?page=index'>úvodní stránku</a>";
						}	
					}else echo "Zadal jsi špatné heslo";
				}else echo "Nezadal jsi heslo";
			}else echo "Uživatel neexistuje";
		}else echo "Nezadal jsi jméno";

	}
}else header("Location: ?page=index");?>