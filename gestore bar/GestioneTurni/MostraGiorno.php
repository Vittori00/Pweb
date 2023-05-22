
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
    //riceviamo dall'utente il giorno che vuole osservare 
    $giorno = $_POST["giorno"];
    $t = restituisci_id($giorno);
    //questa query serve a fornire i turni relativi al giorno, e i dipendenti che sono assegnati a ciasciun turno.
    //si usa left join per ottenere a prescindere dal fatto che siano o meno  presenti
    //dipendenti che coprono quel giorno tutti i turni
    $sql = "SELECT t.ID AS id, d1.Cognome AS b1_cognome, d2.Cognome AS c1_cognome, d3.Cognome AS c2_cognome
    FROM turni t
    LEFT JOIN  dipendenti d1 ON t.B1 = d1.ID
    LEFT JOIN  dipendenti d2 ON t.C1 = d2.ID
    LEFT JOIN  dipendenti d3 ON t.C2 = d3.ID
    WHERE t.ID IN ($t, $t+1, $t+2)";
    $result = $conn->query($sql);
    echo "<h1>" . $giorno . "</h1>";
    echo "<table>";
    echo "<tr><th>Giorno</th><th>Orario</th><th>Barman</th><th>Cameriere 1</th><th>Cameriere 2</th></tr>";
    $i = 0; //variabile necessaria a contare i turni coperti
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $giorno . "</td>";
        $turno = dammi_turno( $row["id"] );
        echo "<td>" . $turno . "</td>";
        //nel caso il turno non sia coperto mostreremo "---"
        if($row["b1_cognome"] == NULL){
            echo "<td> --- </td>";
            echo "<td> --- </td>";
            echo "<td> --- </td>";
        }else{
            $i++; //il turno è coperto
            echo "<td>" . $row["b1_cognome"] . "</td>";
            echo "<td>" . $row["c1_cognome"]. "</td>";
            echo "<td>" . $row["c2_cognome"] . "</td>";
        }

        echo "</tr>";
    }
    echo "</table>";

    //ora stampiamo il numero di turni coperti e non
    if($i == 0){
        echo "<p>Nessun Turno è stato ancora riempito</p>";
    }else if($i == 1){
        echo  "<p>2 Turni ancora non riempiti</p>";
    }else if($i == 2){
        echo  "<p>1 Turno ancora non riempito</p>";
    }else{
        echo  "<p>Questo giorno è completamente coperto</p>";
    }

    
}

//funzioni di utility
function restituisci_id($gg)
{
    switch ($gg) {
        case 'lunedì':
            $value = 1;
            break;

        case 'martedì':
            $value = 4;
            break;

        case 'mercoledì':
            $value = 7;
            break;

        case 'giovedì':
            $value = 10;
            break;

        case 'venerdì':
            $value = 13;
            break;

        case 'sabato':
            $value = 16;
            break;

        case 'domenica':
            $value = 19;
            break;
    }
    return $value;
}

function dammi_turno($number) {
    switch($number % 3) {
      case 0:
        $rit = "23:00-02:00";
        break;
      case 1:
        $rit = "19:00-21:00";
        break;
      case 2:
        $rit = "21:00-23:00";
        break;
    }
    return $rit;
}
?>

    <form method="post" action="gestioneTurni.php">
        <button  type="submit">Torna alla selezione giorni</button>
	</form>
    <?php 
    //per facilitare la navigazione nel caso in cui l'utente voglia prima controllare un giorno
    //e poi modificarlo inseriamo questo form con il passaggio in forma "hidden" 
    //del valore giorno 
    echo '<form method="post" action="AggiornaTurno.php">';
    echo '<input type="hidden" name="giorno" value="'. $giorno . '">';
    echo "<button type='submit' class ='return'>Premi qui per modificare questo giorno </button>";
    echo '</form>';
    ?>
</body>
</html>