<!DOCTYPE html>
<html lang="it">
<head>
	<title>Modifica Serata</title>
    <meta charSet="utf-8">
    <link rel="stylesheet" type="text/css" href="gestioneSettimana.css">
</head>
<body>
<?php
    require_once '../Login/connectdb.php';
    //per prima cosa prendiamo i giorni della settimana
    $sql = "SELECT * FROM settimana";
    $result1 = $conn->query($sql);
    //dopodiché selezioniamo i temi presenti nel database
    $sql = "SELECT * FROM tema";
    $result2 = $conn->query($sql);

    echo "<h1>Scegli un tema per la Serata </h1>";
    //per evitare all'utente di scrivere il tema e il giorno della settimana al qualee assegnarlo 
    //creiamo 2 selettori utilizzando le query sopra per permettere un inserimento più veloce e preciso
    echo '<form method="post" action="UpdateSerata.php">';
    echo '<label for="giorno">Giorno:</label>';
    echo '<select id="giorno" name="giorno">';
    while ($row = mysqli_fetch_assoc($result1)) {
        echo '<option value="' . $row['ID'] . '">' . $row['giorno']  . '</option>';
    }
    echo '</select>';
    echo '<label for="tema">Tema:</label>';
    echo '<select id="tema" name="tema">';
    while ($row1 = mysqli_fetch_assoc($result2)) {
        echo '<option value="' . $row1['ID'] . '">' . $row1['nome']  . '</option>';
    }
    //dobbiamo anche permettere all'utente di rimuovere un tema da una serata senza assegnagne un'altra 
    //per questo passiamo un valore speciale (in questo caso 0) 
    //che poi nel file UpdateSerata sarà codificato in caso si presenti 
    echo '<option value="' . 0 . '"> Nessun Tema </option>';
    echo '</select>';
    echo "<button type='submit'>Assegna la serata</button>";
    echo '</form>';

?>

    <form action="gestioneSettimana.php">
        <button  type="submit"> Torna alla gestione della settimana</button>
	</form>
</body>

