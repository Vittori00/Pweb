<!DOCTYPE html>
<html lang="it">
<head>
	<title>Gestione Turni</title>
    <meta charSet="utf-8">
	<link rel="stylesheet" type="text/css" href="gestioneTurni.css">
</head>
<body>
    <h1> Servizio Gestione Turni </h1>
    <form method="post" action="MostraGiorno.php">
				<label for="giorno">Che giorno vuoi visualizzare?:</label>
				<select id="giorno" name="giorno">
					<option value="lunedì">Lunedi</option>
					<option value="martedì">Martedi</option>
                    <option value="mercoledì">Mercoledi</option>
                    <option value="giovedì">Giovedi</option>
                    <option value="venerdì">Venerdi</option>
                    <option value="sabato">Sabato</option>
                    <option value="domenica">Domenica</option>
				</select>
				<br>
				<button type="submit">Mostrami il giorno</button>
				
	</form>
	<form method="post" action="AggiornaTurno.php">
				<label for="giorno">Aggiorna un Turno per il giorno:</label>
				<select id="giorno1" name="giorno1">
					<option value="lunedì">Lunedi</option>
					<option value="martedì">Martedi</option>
                    <option value="mercoledì">Mercoledi</option>
                    <option value="giovedì">Giovedi</option>
                    <option value="venerdì">Venerdi</option>
                    <option value="sabato">Sabato</option>
                    <option value="domenica">Domenica</option>
				</select>
				<br>
				<button type="submit">Aggiorna Turno</button>
				
	</form>
	<form action="../Amministratori/mainAmministratori.php">
		<button  type="submit"> Torna al menù principale</button>
	</form>

</body>
</html>