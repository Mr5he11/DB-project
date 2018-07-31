<!DOCTYPE html>
<?php

	//richiesta del file di configurazione per la connessione
	require('connect.php');

	//creazione dell'oggetto contenente la connessione
	$conn = Connection::getConnection();

	//generazione delle query necessarie per ottenere gli ultimi film inseriti
	$query = $conn->query('SELECT * FROM Film ORDER BY Id DESC');
	$i = 0;

?>
<head>
	<title>Cinema Italia</title>
	<meta charset="utf-8" />
	<link href="style.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
	<script src="js/cufon-yui.js" type="text/javascript"></script>
	<script src="js/cufon-replace.js" type="text/javascript"></script>
	<script src="js/Gill_Sans_400.font.js" type="text/javascript"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<style>
		.playbill{
			border: 1px solid white;
			height: 190px;
			left: 25%;
		}
	</style>
</head>
<body id="page1">
	<div class="tail-top">
		<div class="tail-bottom">
			<div id="main">
<!-- HEADER -->
				<div id="header">
					<div class="row-1">
						<div class="fleft"><a href="index.html">Cinema <span>Italia</span></a></div>
						<ul>
							<li><a href="index.html"><img src="images/icon1-act.gif" alt="" /></a></li>
							<li><a href="contact-us.html"><img src="images/icon2.gif" alt="" /></a></li>
							<li><a href="sitemap.html"><img src="images/icon3.gif" alt="" /></a></li>
						</ul>
					</div>
					<div class="row-2">
						<ul>
							<li><a href="index.html" class="active">Home</a></li>
							<li><a href="articles.html">Programmazione</a></li>
							<li><a href="contact-us.html">Contattaci</a></li>
						</ul>
					</div>
				</div>
<!-- CONTENT -->
				<div id="content"><div class="ic">More Website Templates at TemplateMonster.com!</div>
					<div id="slogan">
						<div class="image png"></div>
						<div class="inside">
							<h2>Portiamo nelle nostre sale <span>I migliori Film del momento!</span></h2>
							<p>Vieni a trovarci! Non rimarrai deluso 😉</p>
							<div class="wrapper"><a href="#" class="link1"><span><span>Scopri di piu`</span></span></a></div>
						</div>
					</div>
					<div class="box">
						<div class="border-right">
							<div class="border-left">
								<div class="inner">
									<h3>Benvenuto al <b>Cinema</b> <span>Italia</span></h3>
									<p>Il sito web di Cinema Italia e` stato creato da <a rel="nofollow" href="http://sortof430.github.io" class="new_window">Stefano Sello</a> e il suo team.</p>
									<div class="img-box1"><img src="images/1page-img1.jpg" alt="" />Inizialmente questo sito web e` stato creato come progetto finale del corso di progettazione e ottimizzazione di basi di dati dell'universita` <a href=http://www.unive.it/>Ca' Foscari</a> di Venezia. Si sta rivelando, tuttavia, divertente da realizzare e decisamente istruttivo per le tematiche affrontate.</div>
									<p>Nel sito web di Cinema <span>Italia</span> hai la possibilita` di registrarti per prenotare la tua serata film con i tuoi amici o con la tua ragazza!</p>
								</div>
							</div>
						</div>
					</div>
					<!-- Porzione di codice scritta in PHP - prelievo ultimi film dal database -->
					<div class="content">
						<h3>Ultimi <span>Aggiunti</span></h3>
						<ul class="movies">
							<?php while(($row = $query->fetch()) && ($i++ < 3)){ ?>
							<li>
								<h4><a href="<?php echo($row['Collegamento']);?>" target="_blank"><?php echo($row['Titolo']); ?></a></h4>
								<img src="<?php echo($row['Locandina']); ?>" class="playbill"/></br></br>
								<p><?php echo($row['Descrizione']); ?></p>
							</li>
							<?php } ?>
							<li class="clear">&nbsp;</li>
						</ul>
					</div>
				</div>
				<!-- Fine prelievo ultimi film -->
<!-- FOOTER -->
				<div id="footer">
					<div class="left">
						<div class="right">
							<div class="inside">Copyright - <a href="https://sortof430.github.io" target="_blank">Stefano Sello</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>