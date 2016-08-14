<table align="center">
<tr>
	<th colspan="2">Nick</th>
	<th colspan="2">Email</th>
	<th colspan="2">Status</th>
</tr>
<?php
	$data = dibi::fetchAll('SELECT * FROM ucty');
	foreach($data as $user)
	{
		if($user->PublicMail)$mail = $user->Email;
		else $mail = "Neveřejný";
		if($user->Online) $stav = "Online";
		else $stav = "Offline";
		echo "<tr><td colspan='2'>".$user->Name."</td><td colspan='2'>".$mail."</td><td colspan='2'>".$stav."</td></tr>";
	}
?>
</table>