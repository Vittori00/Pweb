
<!DOCTYPE html>
<html lang="it">
<head>
	<title>Gestione Turni</title>
    <meta charSet="utf-8">
    <link rel="stylesheet" type="text/css" href="gestioneTurni.css">
</head><body>
<?php

require_once '../Login/connectdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //parametri forniti dall'utente
    $turno = $_POST["turno"];
    $barman = $_POST["barman"];
    $cameriere1 = $_POST["cameriere1"];
    $cameriere2 = $_POST["cameriere2"];
    //in questo caso i parametri sono tutti controllati
    //poiché sono stati presi da un selettore con all'interno tutti i dipendenti 
    //presenti nel database, quindi non dobbiamo fare prepare della query
    $sql = "SELECT * FROM turni WHERE id = $turno ";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);

    //prima dobbiamo controllare che i camerieri assegnati a quel turno non siano lo stesso
    if($cameriere1 != $cameriere2){
        //query per l'update dei parametri c1 b1 c2 all'interno del turno scelto 
        $sql = "UPDATE turni SET c1 = '$cameriere1', b1 = '$barman', c2 = '$cameriere2' WHERE id = '$turno' ";
        $result = $conn->query($sql);
        //in caso di errore avvisiamo l'utente
        if ($result === false) {
            echo "<h2> Fatal error, provare a chiudere e riaprire la pagina! </h2>" ;
        } else if (mysqli_affected_rows($conn) == 0) {
            echo "<h2> Hai inserito i dipendenti che erano già presenti in quel turno!  </h2> ";
        } else {
            echo "<h2> Turno modificato con successo!";
        }
        echo ""; 
        echo '<form method="post" action="gestioneTurni.php">';
        echo "<button type='submit'>Torna alla pagina di gestione</button> </h2> ";
        echo '</form>';

    }else{ 
        //in caso di errore permettiamo all'utente di tornare al giorno selezionato così da poter ri-inserire
        //correttamente i dipedenti, lo facciamo con un form con parametro giorno passato in modo "hidden"
        echo "<h2>l'inserimento non è andato a buon fine, controlla di non aver inserito lo stesso cameriere! </h2>";
        echo "<div class = 'ritorno' >";
        echo '<form method="post" action="AggiornaTurno.php">';
        echo '<input type="hidden" name="giorno1" value="'. dammi_giorno($turno) . '">';
        echo "<button type='submit' class ='return'>Torna alla modifica  giorno </button>";
        echo '</form>';
        echo '<form method="post" action="gestioneTurni.php" >';
        echo "<button type='submit'  class ='return' >Torna alla gestione turni</button>";
        echo '</form>';
        echo "</div>";
    }

}

//funzioni di utility
function dammi_giorno($id){
    switch($id) {
        case 1:
        case 2:
        case 3:
            $gg = "lunedì";
            break;
        case 4:
        case 5:
        case 6:
            $gg = "martedì";
            break;
        case 7:
        case 8:
        case 9:
            $gg = "mercoledì";
            break;
        case 10:
        case 11:
        case 12:
            $gg = "giovedì";
            break;
        case 13:
        case 14:
        case 15:
            $gg = "venerdì";
            break;
        case 16:
        case 17:
        case 18:
            $gg = "sabato";
            break;
        case 19:
        case 20:
        case 21:
            $gg = "domenica";
            break;
    }
    return $gg;
}
?>

</body>