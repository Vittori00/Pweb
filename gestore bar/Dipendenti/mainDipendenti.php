<!DOCTYPE html>
<html lang="it">
<head>
	<title>Pagina di benvenuto</title>
	<link rel="stylesheet" href="MainDipendenti.css">
	<meta charSet="utf-8">
</head>
<body>
	
	<h1>Bentornato, <?php session_start(); echo $_SESSION["cognome"]; ?> !</h1>
	<?php include 'orario.php' //ho separato la stampa dell'orario su un altra pagina per una gestione più ordinata ?>

</body>
</html>