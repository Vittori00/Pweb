<?php
    require_once '../Login/connectdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //l'utente ha inserito nel forme di gestioneDipedenti.php
    //a questo punto li recuperiamo
    $cognome = $_POST["cognome"];
    $nome = $_POST["nome"];
    $password = $_POST["password"];
    $ruolo = $_POST["ruolo"];

    //a seconda del ruolo avrò 1 o 0 nel record
    if($ruolo == "barman")
        $role = 1; 
    else   
        $role = 0; 

    //controlliamo che non sia presente un altro dipendente con lo stesso cognome e nome e quindi
    //l'utente non provi, per errore o meno, ad inserire due volte lo stesso dipendente
    $sql = "SELECT COUNT(*) AS count FROM dipendenti WHERE cognome = '$cognome' AND nome = '$nome' ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) { //nessun problema

        //i dati che sto per inserire nel database sono forniti dall'utente, per questo ci tuteliamo 
        //proteggendoci da casi di sql injections
        $stmt = $conn->prepare("INSERT INTO dipendenti (nome, cognome, password, ruolo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $cognome, $password, $ruolo);
        $stmt->execute();

    } else { //errore
        // Nome già presente nel database
        $error = "Nome già presente nel database";
    }
    header("Location: gestioneDipendenti.php");//ritorno alla pagina di gestione dipendenti
}

// Chiusura della connessione al database, se non si è passato da dall'if vuol dire che l'utente ha provato ad interagire con la pagina da vie
//secondarie, rischiando di compromettere il database per cui chiudiamo la connessione per evitare rischi
$conn->close();
?>