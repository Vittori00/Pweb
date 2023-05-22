<!DOCTYPE html>
<html lang="it">
<head>
    <meta charSet="utf-8">
    <link rel="stylesheet" type="text/css" href="gestioneSettimana.css">
</head>

<?php
    require_once '../Login/connectdb.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tema = $_POST["tema"];
        $giorno = $_POST["giorno"];
        if($tema == 0){
            //se siamo qua dentro vuol dire che l'utente ha voluto cancellare 
            //la serata, senza assegnargli un altro tema
            $sql = " UPDATE settimana SET tema = NULL WHERE ID = $giorno ";
            $result = $conn->query($sql);

        }else{// aggiorniamo la serata con il tema scelto 
            $sql = " UPDATE settimana SET tema = $tema WHERE ID = $giorno ";
            $result = $conn->query($sql);
        }   
        //ritorniamo al calendario con i temi assegnati alle serate dopo la modifica
        //così da mostrare il corretto inserimento 
        header("Location: gestioneSettimana.php");
    }
    // Chiusura della connessione al database
    $conn->close();
?>