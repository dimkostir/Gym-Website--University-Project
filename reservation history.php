<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "gym_ergasia";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Αποτυχία σύνδεσης στη βάση δεδομένων: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];

    // κρατήσεις για το συγκεκριμένο username
    $selectReservationsQuery = "SELECT program, program_date FROM users WHERE username = '$username'";
    $reservationsResult = $conn->query($selectReservationsQuery);

    if ($reservationsResult === false) {
        echo "<p>Σφάλμα κατά την εκτέλεση του ερωτήματος: " . $conn->error . "</p>";
    } else {
        echo "<h2>Ιστορικό Κρατήσεων για τον χρήστη $username</h2>";

        if ($reservationsResult->num_rows > 0) {
            //ιστορικό κρατήσεων
            while ($row = $reservationsResult->fetch_assoc()) {
                echo "<p>Πρόγραμμα: " . $row['program'] . ", Ημερομηνία: " . $row['program_date'] . "</p>";
            }
        } else {
            echo "<p>Δεν υπάρχουν καταχωρημένες κρατήσεις.</p>";
        }
    }
}

$conn->close();
?>
