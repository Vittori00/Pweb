<!DOCTYPE html>
<html lang="it">
<head>
	<title>Gestione Turni</title>
    <meta charSet="utf-8">
    <link rel="stylesheet" type="text/css" href="gestioneSettimana.css">
</head>
<body>
<h1 class ="elenco"> Ecco un elenco delle serate già presenti </h1>
<div class = "contenitore">
<?php
        require_once '../Login/connectdb.php';

    //selezioniamo tutti i temi con la query
    $sql = "SELECT * FROM tema";
    $result = $conn->query($sql);
    
    echo "<table>";
    echo "<tr><th>Tema</th><th>Descrizione</th></tr>";
    //a questo punto stampiamo i temi già presenti nel database 
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
            echo "<td>" . $row["nome"]  . "</td>";
            echo "<td>" . $row["descrizione"]  . "</td>";
    }
    echo "</table>";
?>

<form method="post" action="NewSerata.php" class="inserimento">
<label for="tema">Tema serata:</label>
  <input type="text" id="tema" name="tema" required>
  
  <label for="descrizione">Descrizione della serata:</label>
  <textarea id="descrizione" name="descrizione" required onclick="if(this.value=='Inserisci la descrizione'){this.value=''}">Inserisci la descrizione</textarea> 
  
  <button type="submit">Aggiungi Serata</button>
  
</form>
<form action="gestioneSettimana.php" class="invia">
    <button type="submit" class="bottone"> Torna alla gestione della settimana</button>
</form>
</div>

</body>
