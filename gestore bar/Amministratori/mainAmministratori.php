<!DOCTYPE html>
<html lang="it">

<head>
<meta charSet="utf-8">
	<title>Pagina di benvenuto</title>
	<link rel="stylesheet" type="text/css" href="MainAmministratori.css">
</head>
<?php 
	//recuperiamo la sessione per ricavare il nome dell'utente
	session_start();
?>
<body>
	<div class="container">
		<header>
			<h1>Bentornato,
				<?php 
					echo $_SESSION["cognome"]; //nome utente loggato
				?> !
			</h1>
		</header>
		<main>
			<div class="credenziali">
				<form action="../GestioneTurni/gestioneTurni.php" method="post">
					<button class="linker"> Gestione Turni</button>
				</form>
				<form action="../GestioneSettimana/gestioneSettimana.php" method="post">
					<button class="linker"> Gestione Settimana</button>
				</form>
				<form action="../GestioneDipendenti/gestioneDipendenti.php" method="post">
					<button class="linker"> Gestione Personale</button>
				</form>
			</div>
		</main>
	</div>

</body>

</html>