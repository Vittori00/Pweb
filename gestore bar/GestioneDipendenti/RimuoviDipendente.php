<!DOCTYPE html>
<html lang="it">
<head>
	<title>Gestione Dipendenti</title>
    <meta charSet="utf-8">
    <link rel="stylesheet" type="text/css" href="gestioneDipendenti.css">
</head>
<body>
  


<?php
    require_once '../Login/connectdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //nella pagina di gestione ci è stato fornito l'id del dipendente così da evitare problemi di omonimi
    $id = $_POST["cognomeRimozione"]; 
    //prima di rimuovere questo dipendente dobbiamo controllare se ha o meno turni in questa settiamana
    //poiché in tal caso sarà necessario prima sostituirlo nei turni in cui è presente
    $sql = "SELECT COUNT(*) AS count FROM turni WHERE b1 = '$id' OR c1 = '$id' OR c2 = '$id' ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    //il dipendente ha dei turni questa settimana
    if ($row['count'] != 0) { 
      echo "<h1>il dipendente ha ". $row['count'] ." turni questa settimana, assicurati di riassegnarli prima di rimuoverlo </h1>";
      echo '<form method="post" action="gestioneDipendenti.php">';
      echo "<button type='submit'> torna alla pagina di gestione dipendenti </button>";
      echo '</form>';
    }
    //possiamo rimuovere il dipendente poiché non ha turni questa settimana
    else{
      $sql = "DELETE FROM dipendenti WHERE ID = '$id'";
      if ($conn->query($sql) === TRUE) {
        echo "Record rimosso con successo";
      } else {
        echo "Errore nella rimozione del record" ;
      }
      header("Location: gestioneDipendenti.php");//ritorno alla pagina di gestione 
    }
    
}

// Chiusura della connessione al database, caso di errore
$conn->close();
?>
</body>