
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

    $giorno = $_POST["giorno1"];
    $t = restituisci_id($giorno);

    //query per selezionare i turni relativi al giorno scelto
    //sarà possibile sia cambiare turni già prestabiliti che quelli ancora non riempiti
    $sql = "SELECT t.ID AS id
    FROM turni t
    WHERE t.ID IN ($t, $t+1, $t+2) ";
    $result = $conn->query($sql);
    //query per barman
    $sql2 = "SELECT * FROM dipendenti WHERE ruolo = 1";
    $result2 = $conn->query($sql2);
    //query per camerieriere 1 
    $sql3 = "SELECT * FROM dipendenti WHERE ruolo = 0";
    $result3 = $conn->query($sql3);
    //query per camerieriere 2 
    $sql4 = "SELECT * FROM dipendenti WHERE ruolo = 0";
    $result4 = $conn->query($sql4);

    echo "<h1> ". $giorno ."</h1>";
    //stampo il menù a tendina dove scelgo turno da cambiare, barman e i due camerieri
    echo '<form method="post" action="UpdateTurno.php" class="credenziali">';
    echo '<label for="turno">Turno:</label>';
    echo '<select id="turno" name="turno">';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . dammi_turno($row['id']) . '</option>';
    }
    echo '</select>';
    echo '<label for="barman">Barman:</label>';
    echo '<select id="barman" name="barman">';
    while ($row1 = mysqli_fetch_assoc($result2)) {
        echo '<option value="' . $row1['ID'] . '">' . $row1['cognome']  . '</option>';
    }
    echo '</select>';
    echo '<label for="cameriere1">Primo Cameriere:</label>';
    echo '<select id="cameriere1" name="cameriere1">';
    while ($row2 = mysqli_fetch_assoc($result3)) {
        echo '<option value="' . $row2['ID'] . '">' . $row2['cognome'] . '</option>';
    }  
    echo '</select>'; 
    echo '<label for="cameriere2">Secondo Cameriere:</label>';
    echo '<select id="cameriere2" name="cameriere2">';
    while ($row3 = mysqli_fetch_assoc($result4)) {
        echo '<option value="' . $row3['ID'] . '">' . $row3['cognome'] . '</option>';
    }
    echo '</select>';
    echo "<button type='submit'>Modifica Turno</button>";
    echo '</form>';
    
    echo '<form action="gestioneTurni.php">';
	echo '<button  type="submit"> Torna alla gestione dei turni</button> ';
	echo "</form>";
}


//funzioni di utility 
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

?>


</body>