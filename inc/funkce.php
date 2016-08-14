<?php
function PageSystem()
{
        if(isset($_GET['page']))
        {
                if (file_exists("inc/pages/".$_GET['page'].".php"))
                {
                        include("inc/pages/".$_GET['page'].".php");
                } else {
                        echo 'ERROR 404 FILE NOT FOUND';
                }
        } else {
                include("inc/pages/index.php");
        }
}

function DatabaseConnect()
{
	require(dirname(__DIR__)."/inc/lib/dibi/dibi.php");
	dibi::connect(array(
		'driver'   => 'mysql',
		'host'     => 'wm12.wedos.net',
		'username' => 'a8692_pawno',
		'password' => 'pawnodatabaze',
		'database' => 'd8692_pawno',
		'charset'  => 'cp1250',
	));
}

?>