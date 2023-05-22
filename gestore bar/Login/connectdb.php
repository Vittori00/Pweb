<?php
//Prevents CORS blocking HTTP request from another domain (localhost:3000) 
//parte di codice necessaria per poter utilizzare senza alcun problema il metodo post
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
//ci connettiamo utlizzando il metodo mysqli
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "vittori_603188";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connessione fallita: " . $conn->connect_error);
}

?>

