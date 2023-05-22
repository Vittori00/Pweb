<?php
require_once '../Login/connectdb.php';
// Gestione dell'autenticazione
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $cognome = $_POST["cognome"];
    $password = $_POST["password"];
    $ruolo = $_POST["ruolo"];
    // a seconda del ruolo avremo percorsi differenti
    if ($ruolo == "amministratore") {
        //per l'autenticazione controlliamo se l'utente ha inserito dati presenti nel database
        $sql = "SELECT * FROM amministratori WHERE cognome='$cognome' AND password='$password'";
        $result = $conn->query($sql);
        if ($result === false) {
            echo "<h2> Fatal error, provare a chiudere e riaprire la pagina! </h2>" ;
        } 
        //l'utente è presente nel database, ci portiamo nel main Amministratori
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $id = $row['ID'];
            // Login effettuato con successo
            session_start();
            $_SESSION["cognome"] = $cognome;
            $_SESSION["ruolo"] = "amministratore";
            $_SESSION["id"] = $id; 
            header("Location: ../Amministratori/mainAmministratori.php"); //pagina amministratori 
        } else {
            // Credenziali errate
            $error = "Credenziali errate. Riprova.";
            header("Location: ../index.html");//ritorno alla pagina di login in caso di errore
        }
    } else if ($ruolo == "dipendente") { //else if e non solo else per prevenire errori 
         //per l'autenticazione controlliamo se l'utente ha inserito dati presenti nel database
        $sql = "SELECT * FROM dipendenti WHERE cognome='$cognome' AND password='$password'";
        $result = $conn->query($sql);
        //l'utente è presente nel database, ci portiamo nel main Dipendenti
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $id = $row['ID'];
            // Login effettuato con successo
            session_start();
            $_SESSION["cognome"] = $cognome;
            $_SESSION["ruolo"] = "dipendente";
            $_SESSION["id"] = $id;
            header("Location: ../Dipendenti/mainDipendenti.php");  //pagina Dipendenti 
        } else {
            // Credenziali errate
            $error = "Credenziali errate. Riprova.";
            header("Location: ../index.html"); //ritorno alla pagina di login in caso di errore

        }
    }
}

// Chiusura della connessione al database
//se non si passa prima dall'if vuol dire che 
//l'utente stava cercando di accedere a questa pagina in modo non corretto
$conn->close();
?>