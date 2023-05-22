<!DOCTYPE html>
<html lang="it">
<head>
	<title>Gestione Dipendenti</title>
    <meta charSet="utf-8">
    <link rel="stylesheet" type="text/css" href="gestioneDipendenti.css">
</head>
<body>
	
	<h1 > Camerieri </h1>
    <?php
        //stampiamo in una tabella tutti i camerieri 
           require_once '../Login/connectdb.php';
        //per prima cosa con la query recuperiamo i camerieri, ossia i dipedenti che hanno
        //come ruolo il valore 0
        $sql = "SELECT nome, cognome FROM dipendenti WHERE ruolo = 0";
        $result = $conn->query($sql);

        echo "<table> ";
        echo "<tr><th>Nome</th><th>Cognome</th></tr>";
        //stampiamo la tabella facendo fetch del risultato della query
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";          
            
            echo "<td>" .  $row["nome"]  . "</td>";

            echo "<td>" .  $row["cognome"]  . "</td>";

            echo "</tr>";
        }

        echo "</table>";
        ?>
    <h1> Barman </h1>
    <?php
        //ora invece dobbiamo recuperare i barman, ossia i dipendenti che hanno valore
        //di ruolo uguale ad 1
        $sql = "SELECT nome, cognome FROM dipendenti WHERE ruolo = 1;";
        $result = $conn->query($sql);

        echo "<table>";
        echo "<tr><th>Nome</th><th>Cognome</th></tr>";
         //stampiamo la tabella facendo fetch del risultato della query
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";

            echo "<td>" . $row["nome"] . "</td>";

            echo "<td>" . $row["cognome"] . "</td>";

            echo "</tr>";
        }

        echo "</table>";
    ?>
    <div class = "contenitore">
    <form method="post" action="AddDipendenti.php">
				<label for="cognome">Cognome:</label>
				<input type="text" id="cognome" name="cognome" required>
				<br>
                <label for="nome">Nome:</label>
				<input type="text" id="nome" name="nome" required>
				<br>
				<label for="password">Password:</label>
				<input type="password" id="password" name="password" required>
				<br>
				<label for="ruolo">Ruolo:</label>
				<select id="ruolo" name="ruolo">
					<option value="barman">Barman</option>
					<option value="cameriere">Cameriere</option>
				</select>
				<br>
				<button type="submit">Aggiungi Dipendente</button>
	</form>
    <form method="post" action="RimuoviDipendente.php">
        <?php
            //qui ci occupiamo della rimozione di dipendenti 
            //per evitare che sia l'utente a scrivere il nome del dipendente da rimuovere
            //cosa estremamente macchinosa e che potrebbe dare sia problemi di sicurezza
            //che rendere l'esperienza meno fluida dato che l'utente potrebbe sbagliare a scrivere il nome
            //stampiamo un selettore con all'interno i dipendenti presenti 
            $sql = "SELECT * FROM dipendenti";
            $result = $conn->query($sql);
            //ciò che prenderemo dal selettore non sarà il cognome ma l'id del dipendente così da implementare in modo più efficace la rimozione
            echo '<label for="cognomeRimozione">Dipendente da rimuovere:</label>';
            echo '<select id="cognomeRimozione" name="cognomeRimozione">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['ID'] . '">' . $row['cognome']  . '</option>';
            }
            echo '</select>';
        ?>
        <button type="submit">Rimuovi Dipendente</button>
    </form>
    </div>
    <form action="../Amministratori/mainAmministratori.php">
					<button  type="submit" class="bottone"> Torna al menù principale</button>
	</form>

</body>
</html>