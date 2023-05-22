<!DOCTYPE html>
<html lang="it">
<head>
	<title>Gestione Settimana</title>
    <meta charSet="utf-8">
    <link rel="stylesheet" type="text/css" href="gestioneSettimana.css">
</head>
<body>
<?php

    require_once '../Login/connectdb.php';   
    //dobbiamo stampare una tabella con il giorno della settimana
    //e il tema che gli è stato assegnato, oppure "---" in caso 
    //nessun tema sia assegnato a quel giorno, quindi 
    //con left joint ci assicuriamo che siano presenti tutti i giorni della settimana
    $sql = "SELECT settimana.giorno AS giorno, tema.nome AS nome, tema.descrizione AS descrizione
    FROM settimana
    LEFT JOIN tema ON settimana.tema = tema.ID";
    $result = $conn->query($sql);

    echo "<table>";
    echo "<tr><th>Giorno</th><th>Tema</th><th>Descrizione</th></tr>";
    //scorriamo giorno per giorno 
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        //nel caso nessun tema sia assegnato a quel giorno 
        if($row["nome"] == NULL){
            echo "<td>" . $row["giorno"] . "</td>";
            echo "<td> --- </td>"; 
            echo "<td> --- </td>";
        }else{ //un tema è assegnato a quel giorno 
            echo "<td>" . $row["giorno"] . "</td>";
            echo "<td>" . $row["nome"]  . "</td>";
            echo "<td>" . $row["descrizione"]  . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
?>

    <form method="post" action="ModificaSerata.php">
				<button type="submit">Premi qui per assegnare un tema ad un giorno</button>
	</form>
	<form method="post" action="AggiungiSerata.php">
				<button type="submit">Premi qui per aggiungere un nuovo tipo di tema per una serata</button>
	</form>
    <form action="../Amministratori/mainAmministratori.php">
    <button  type="submit"> Torna al menù principale</button>
	</form>
</body>
</html>