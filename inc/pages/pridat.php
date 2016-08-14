<table>
	<form method="POST">
		<tr><th colspan="2">Přidání serveru do databáze</th></tr>
		<tr>
			<td><label for="servr">IP:PORT</label></td>
			<td><input type="text" name="servr" value="127.0.0.1:27015" onclick="this.value =''"></td>
		</tr>
		<tr><td colspan="2"><input type="submit" class="frm" name="pridat" value="Přidat Server"></td></tr>
	</form>
</table>
<?php
if(@$_POST["pridat"])
{
	if($_POST["servr"] != "127.0.0.1:27015" or "")
	{
		$adresa = explode(':',$_POST["servr"]);
		
		$data = dibi::query('SELECT * FROM server_list WHERE Ip = %s and Port = %i', $adresa[0],$adresa[1]);
		if(count($data) == 0)
		{
			$arr = array(
				'Ip' => $adresa[0],
				'Port'  => $adresa[1],
			);
			
			if(dibi::query("INSERT INTO server_list",$arr))
			{
				echo "přidáno";
			}else{ echo "nepřidáno"; }
		}else{ echo "tento server existuje"; }
	}else{ echo "nezadal jsi IP"; }
}




?>