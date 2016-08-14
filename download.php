<?php
$file = $_GET["file"];
header('Content-type: text/plain');
header('Content-Disposition: attachment; filename="'.$file.'"');
readfile("./files/".$file);
?>