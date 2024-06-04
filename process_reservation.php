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
    $program = $_POST["program"];
    $date = $_POST["date"];

    // Ελέγχουμε αν το username υπάρχει στον πίνακα users
    $checkUserQuery = "SELECT * FROM users WHERE username = '$username'";
    $userResult = $conn->query($checkUserQuery);

    if ($userResult->num_rows > 0) {
        // Το username υπάρχει, καταχωρούμε τα πεδία program και program_date
        $insertProgramQuery = "UPDATE users SET program = '$program', program_date = '$date' WHERE username = '$username'";
        if ($conn->query($insertProgramQuery) === TRUE) {
            echo "Η κράτηση πραγματοποιήθηκε με επιτυχία!";
        } else {
            echo "Σφάλμα καταχώρησης κράτησης: " . $conn->error;
        }
    } else {
        echo "Το όνομα χρήστη δεν υπάρχει στη βάση δεδομένων.";
    }
}

$conn->close();
?>
