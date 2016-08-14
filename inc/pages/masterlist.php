<?php

require(dirname(__DIR__)."/lib/IV-MP_QUERY.php");
$data = dibi::fetchAll('SELECT * FROM server_list');
$pocet = count($data);
?>

<table style="text-align:center;">
	<tr>
		<th colspan="5">Hostname</th>
		<th>Zámek</th>
		<th>Sloty</th>
		
		<th colspan="2">Adresa</th>
	</tr>
<?php
	if($pocet > 0)
	{
		foreach($data as $radek)
		{
			$q = new IVMPQuery;
			if(!$q->Query($radek->Ip,$radek->Port,$errno,$errstr,2))
			{
				echo "<tr><td colspan =\"9\">Failed to query server (".$errstr.")</td></tr>";
			}
			else
			{
				$server = $q->ServerData();
				if($server["passworded"]) $zamek = "Ano";
				else $zamek = "Ne";
				echo "<tr><td colspan=\"5\">".$server['hostname']."</td><td>".$zamek."</td><td>".$server['players']."/".$server['maxplayers']."</td><td colspan=\"2\">".$radek->Ip.":".$radek->Port."</td></tr>";
			}
		}
	}else{ echo "<tr><td colspan =\"9\">Nejsou žádné servery v databázi</td></tr>";}?>
</table>



	