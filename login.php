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
    $password = $_POST["password"];

    // έλεγχος στοιχείων εισόδου με τη βάση δεδομένων
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);


        // Επαλήθευση του κωδικού
        if (password_verify($password, $hashed_password)) 
            {
            // Επιτυχής σύνδεση
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['type'] = $row['type'];
            header("Location: homepage.html");
            exit();
        } else {
            echo "Λανθασμένος κωδικός.";
        }
    } else {
        echo "Λανθασμένο όνομα χρήστη.";
    }
}

$conn->close();
?>
