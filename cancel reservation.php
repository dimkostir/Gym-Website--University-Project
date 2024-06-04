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



// username από τη φόρμα
$username = $_POST['username'];

// Επιλέγουμε το πεδίο program_date από τον πίνακα users για το συγκεκριμένο username
$selectProgramDateQuery = "SELECT program_date FROM users WHERE username = '$username'";
$result = $conn->query($selectProgramDateQuery);
date_default_timezone_set('Europe/Athens');

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $programDate = $row['program_date'];

    $currentDateTime = new DateTime();
    $reservationDateTime = new DateTime($programDate);

    // Υπολογίζουμε τη διαφορά σε ώρες
    $interval = $currentDateTime->diff($reservationDateTime);
    $hoursDifference = $interval->h + ($interval->days * 24);

    // Ελέγχουμε αν έχουν περάσει λιγότερες από 2 ώρες
    if ($hoursDifference < 2) {
        echo "Μπορείτε να ακυρώσετε την κράτηση μέχρι 2 ώρες πριν την ώρα έναρξης.";
    } else {
        echo "Δεν επιτρέπεται η ακύρωση κράτησης λιγότερο από 2 ώρες πριν την ώρα έναρξης.";
    }
} else {
    echo "Δεν βρέθηκαν κρατήσεις για το συγκεκριμένο username.";
}
}

?>
