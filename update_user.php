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

// Ελέγχουμε αν έχει γίνει αίτηση ενημέρωσης
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $selectedUsername = $_POST['selectedUsername'];
    $newPassword = $_POST['newPassword'];
    $newUsername = $_POST['newUsername'];
    $newType = $_POST['newType'];

    // Ενημέρωση των στοιχείων του χρήστη
    $updateUserQuery = "UPDATE users SET username = '$newUsername', password = '$newPassword', type = '$newType' WHERE username = '$selectedUsername'";

    if ($conn->query($updateUserQuery) === TRUE) {
        echo "Τα στοιχεία του χρήστη ενημερώθηκαν με επιτυχία.";
    } else {
        echo "Σφάλμα κατά την ενημέρωση των στοιχείων του χρήστη: " . $conn->error;
    }
}

// Λήψη των τρεχόντων στοιχείων του επιλεγμένου χρήστη
if (isset($_GET['SelectedUsername'])) {
    $selectedUsername = $_GET['SelectedUsername'];
    $selectUserQuery = "SELECT * FROM users WHERE username = '$selectedUsername'";
    $userResult = $conn->query($selectUserQuery);

    if ($userResult->num_rows > 0) {
        $row = $userResult->fetch_assoc();
        $currentUsername = $row['username'];
        $currentPassword = $row['password'];
        $currentType = $row['type'];
    } else {
        //echo "Δεν βρέθηκαν στοιχεία για τον επιλεγμένο χρήστη.";
        exit();
    }
} else {
    echo "Δεν ορίστηκε επιλεγμένος χρήστης.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<!-- προσθήκη νέου χρήστη από τον διαχειριστή -->
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Ενημέρωση Χρήστη</title>
    <link rel="stylesheet" type="text/css" href="CSS/update_user.css">
    <nav>
    <a href="homepage.html">Αρχική</a> 
    </nav>
</head>
<body>

    <h2>Ενημέρωση Χρήστη: <?php echo $selectedUsername; ?></h2>

    <form method="post" action="">

        <label for="new_password">Νέος Κωδικός:</label>
        <input type="password" name="newPassword" value="<?php echo $currentPassword; ?>" required>

        <label for="new_username">Νέο username:</label>
        <input type="text" name="newUsername" value="<?php echo $currentUsername; ?>" required>

        <label for="new_role">Νέος Ρόλος:</label>
        <input type="text" name="newType" value="<?php echo $currentType; ?>" required>

        <input type="hidden" name="selectedUsername" value="<?php echo $selectedUsername; ?>">
 
        <input type="submit" name="update" value="Ενημέρωση">
    </form>

</body>
</html>
