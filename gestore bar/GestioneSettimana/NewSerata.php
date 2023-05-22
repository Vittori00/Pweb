<!DOCTYPE html>
<html lang="it">
<head>
	<title>Gestione Turni</title>
    <meta charSet="utf-8">
</head>
<?php
        require_once '../Login/connectdb.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tema = $_POST["tema"];
        $descrizione = $_POST["descrizione"];

        //il tema e la descrizione della serata sono valori passati dall'utente 
        //per cui prima di inserirli c'è bisogno di prepare la query 
        //proteggendoci da eventuali inizioni di sql 
        $stmt = $conn->prepare("INSERT INTO tema (nome, descrizione) VALUES (?, ?)");
        $stmt->bind_param("ss", $tema, $descrizione);
        $stmt->execute();  
        //dopo l'inserimento, nel caso sia avvenuto, torniamo sulla schermata dei temi 
        //così da mostrarlo a schermo e far vedere all'utente il corretto inserimento 
        header("Location: AggiungiSerata.php");      
    }
    // Chiusura della connessione al database
    $conn->close();
?>
