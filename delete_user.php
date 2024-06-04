<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gym_ergasia";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Αποτυχία σύνδεσης στη βάση δεδομένων: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   if (isset($_POST['reject'])) {
        $SelectedUsername = $_POST['SelectedUsername'];
        $deleteRequestQuery = "DELETE * FROM users WHERE username = '$SelectedUsername'";
        if ($conn->query($deleteRequestQuery) === TRUE) {
            echo "Τα στοιχεία του αιτήματος διαγράφηκαν με επιτυχία.";
        } else {
            echo "Σφάλμα κατά τη διαγραφή των στοιχείων του αιτήματος: " . $conn->error;
        }
    }
}

$conn->close();
?>
