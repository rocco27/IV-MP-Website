<?php
if($_SESSION["LoggedIn"])
{
	$pole = array('Online'=>0,);
	dibi::query("UPDATE ucty SET", $pole,"WHERE Name=%s", $_SESSION["Nick"]);
	$_SESSION = array();
	session_destroy();
	echo "Byl jsi úspěšně odhlášen. Přejdi a <a href='?page=index'>úvodní stránku</a>";
}else{ echo "Nejsi přihlášen k žádnému účtu. Nemůžeš být tedy odhlášen!! Přejdi a <a href='?page=index'>úvodní stránku</a>"; }
?>