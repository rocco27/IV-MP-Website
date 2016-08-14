<?php 
	$Timer = MicroTime( true );
	include "./inc/funkce.php";
	DatabaseConnect();
	session_start();
	$pocet = dibi::fetchAll('SELECT * FROM server_list');
	$kolik = count($pocet );

	$pocet2 = dibi::query('SELECT * FROM ucty WHERE Online=1');
	$kolik2 = count($pocet2 );
	$pocet3 = dibi::query('SELECT * FROM ucty');
	$kolik3 = count($pocet3 );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<META HTTP-EQUIV="content-language"CONTENT="cs">
		<META HTTP-EQUIV="content-type"CONTENT="text/html; charset=utf-8">
		<META NAME="description"CONTENT="popis">
		<META NAME="keywords"CONTENT="keywordy">
		<META NAME="googlebot"CONTENT="index,follow,snippet,archive">
		<META NAME="robots"CONTENT="index,follow">
		<META NAME="author"CONTENT="Ewwe">
		<META NAME="owner"CONTENT="Ewwe">
		<META NAME="webmaster"CONTENT="Ewwe">
		<META NAME="copyright"CONTENT="Ewwe © 2012">
		<link rel="stylesheet"href="./inc/style/styles.css"type="text/css"/>
		<script type="text/javascript"src="./inc/lib/jquery-1.8.3.min.js"></script>
		
		<link rel="shortcut icon" href="./inc/style/images/favicon.ico">
		<Title>IV-MP.CZ</Title>
	</head>
	<body>
	  <!--<div id="topblack"></div>-->
		<div id="bg-top">
			<div class="container">
				<a href="/download.php?file=IVMP-0.1-T3.zip"><div id="btn-download"></div></a>
			</div>
			<div id="logo"><img src="./inc/style/images/logo.png" ondragstart="return false"></div>
			<ul id="menu">
				<li><a href="?page=index">Novinky</a></li>
				<li><a href="?page=masterlist">Databáze</a><span class="num"><?php echo $kolik ;?></span></li>
				<li><a href="?page=members">Členové</a><span class="num"><?php echo $kolik2." z ".$kolik3 ;?></span></li>
				<?php 
					if($_SESSION["LoggedIn"])
					{?>
				<li><a href="?page=pridat">Přidat server</a></li>
				<li><a href="?page=profile">Profil</a></li>
				<li><a href="?page=dislog">Odhlásit</a></li>
				<?php
					}else{
				?>
				<li><a href="?page=register">Registrovat</a></li>
				<li><a href="?page=login">Přihlásit</a></li>
				<?php } ?>
			</ul>
		</div>
		<div id="content">
			<div id="right">
				<div class="p-panel">
					<div class="p-caption">Kontakt</div>
					<div class="p-content">
						<div id="ads">
							Email : ceo(at)ewolutions.cz
						</div>
					</div>
				</div>  
				<div class="p-panel">
					<div class="p-caption">Reklama</div>
					<div class="p-content">
						<div id="ads">
							<a href="#"><img src="/inc/style/images/reklama.png"></a>
							<a href="#"><img src="/inc/style/images/reklama.png"></a>
							<a href="#"><img src="/inc/style/images/reklama.png"></a>
						</div>
					</div>
				</div>    
			</div>
			<div id="left">
				<?php PageSystem();?>
			</div>    
			<div id="footer">
				<div id="f-left">
					<a href="#">IV-MP.cz</a> &copy 2012
					<?php if($_GET['page'] == "masterlist"){?>
					
						
					<?php } ?>
				</div>
				<div id="f-right">
					<p>Vygenerováno za <span class="badge badge-success"><?php echo Number_Format( ( MicroTime( true ) - $Timer ), 4, '.', '' ); ?>s</span></p>
				</div>
			</div>
		</div>
	</body>
</html>
