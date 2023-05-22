<?php
    require_once '../Login/connectdb.php';
    
    //qui stamperò l'orario per ogni dipendente.

    //selezioniamo innanzitutto il totale delle ore di lavoro in questa settimana del dipendente 
    $sql = "SELECT COUNT(*) AS totale FROM turni WHERE b1 = {$_SESSION['id']} OR c1 = {$_SESSION['id']} OR c2 = {$_SESSION['id']}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo " <div id='ore-lavoro'> ";
    echo "<p> Totale ore questa settimana: " . 3 * $row['totale'] .  " </p>";

    //ora selezioniamo i turni affidati ad esso
    $sql = "SELECT * FROM turni WHERE b1 = {$_SESSION['id']} OR c1 = {$_SESSION['id']} OR c2 = {$_SESSION['id']}";
    $result = $conn->query($sql);

    echo "<table>";
    echo "<tr><th>Giorno</th><th>Orario</th></tr>";
    //stampiamo riga per riga i turni del dipendente in una tabella
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        $giorno = dammi_giorno($row["ID"]);
        echo "<td>" . $giorno . "</td>";
        $turno = dammi_turno($row["ID"]);
        echo "<td>" . $turno . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo   "</div>"; 


    //FUNZIONI DI UTILITY PER LA STAMPA DELLA TABELLA DEI TURNI 


    //funzione che dato l'id di un turno mi restituisce il giorno del quale quel turno fa parte
    function dammi_giorno($id){
        switch($id) {
            case 1:
            case 2:
            case 3:
                $gg = "lunedi";
                break;
            case 4:
            case 5:
            case 6:
                $gg = "martedi";
                break;
            case 7:
            case 8:
            case 9:
                $gg = "mercoledi";
                break;
            case 10:
            case 11:
            case 12:
                $gg = "giovedi";
                break;
            case 13:
            case 14:
            case 15:
                $gg = "venerdi";
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
            default:
                $gg = "Valore ID non valido";
        }
        return $gg;
    }

    //funzione che serve alla stampa degli orari del turno 
    function dammi_turno($number) {
        switch($number % 3) {
          case 0:
            $turno = "23:00-02:00";
            break;
          case 1:
            $turno = "19:00-21:00";
            break;
          case 2:
            $turno = "21:00-23:00";
            break;
          default:
            return "";
        }
        return $turno;
    }   

?>