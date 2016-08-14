<form method="POST">
<table>
	<tr>
		<td>
			<lable for="nick"><b>Nick</b></label>
		</td>
		<td>	
			<input type="text" name="nick">
		</td>
	</tr>
	<tr>
		<td>
			<lable for="heslo"><b>Heslo</b></label>
		</td>
		<td>	
			<input type="password" name="heslo">
		</td>
	</tr>
	<tr>
		<td>
			<lable for="mail"><b>Email</b></label>
		</td>
		<td>	
			<input type="text" name="mail">
		</td>
	</tr>
	<tr><td colspan="2"><input type="submit" class="frm" name="register" value="Registrovat"></td></tr>
</table>
</form>

<?php
	if(@$_POST["register"])
	{
		if($_POST["nick"] != "")
		{
			$username = dibi::query("SELECT * FROM ucty WHERE Name=%s",htmlspecialchars($_POST["nick"]));
			$lidi = count($username);
			if($lidi == 0)
			{
				if($_POST["heslo"] != "")
				{
					if($_POST["mail"] != "")
					{
						$email = dibi::query("SELECT * FROM ucty WHERE Email=%s",htmlspecialchars($_POST["mail"]));
						$mailu = count($email);
						if(mailu == 0)	
						{
							$hashed_pw = hash("sha512",$_POST["heslo"]);
							$pole = array(
								'Name' => htmlspecialchars($_POST["nick"]),
								'Pass' => $hashed_pw,
								'Email' => htmlspecialchars($_POST["mail"]),
								'RegIp' => $_SERVER["REMOTE_ADDR"],
								'LasIp' => $_SERVER["REMOTE_ADDR"],
								'RegDate' => Time(),
								'LastDate' => Time(),
								'Admin' => 0,
								);
							if(dibi::query("INSERT INTO ucty",$pole))
							{	
								echo"vitej";
							}else echo "chyba mysql";
						}else echo "email existuje";
					}else echo "nezadany mail";
				}else echo "nezadane heslo";
			}else echo "uzivatel existuje";
		}else echo "nezadane jmeno";
	

	}


?>