<!-- Daniela Gamez -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$DB = "pt03_daniela_gamez";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$DB", $username, $password);
} catch(PDOException $e) {
  $conn = null;
}

if ($conn == null) {
  echo '<script>alert("No hi ha cap BD conectada");</script>';
}
?>