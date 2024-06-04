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
// Λειτουργία Create
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {

    $newUserID = $_POST['new_userid'];
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];
    $newFirstName = $_POST['new_firstname'];
    $newLastName = $_POST['new_lastname'];
    $newEmail = $_POST['new_email'];
    $newCountry = $_POST['new_country'];
    $newCity = $_POST['new_city'];
    $newAddress = $_POST['new_address'];
    $newType = $_POST['new_Type'];

    $insertUserQuery = "INSERT INTO users (userid, username, password, firstname, lastname,email, country, city, address,type) VALUES ('$newUserID','$newUsername', '$newPassword','$newFirstName','$newLastName','$newEmail','$newCountry','$newCity','$newAddress', '$newType')";

    if ($conn->query($insertUserQuery) === TRUE) {
        echo "Ο χρήστης δημιουργήθηκε με επιτυχία.";
    } else {
        echo "Σφάλμα κατά τη δημιουργία χρήστη: " . $conn->error;
    }
}


$selectUsersQuery = "SELECT * FROM users";
$usersResult = $conn->query($selectUsersQuery);

?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Διαχείριση Χρηστών</title>
    <link rel="stylesheet" type="text/css" href="CSS/manage_users.css"> 
    <nav>
    <a href="homepage.html">Αρχική</a> 
    </nav>
</head>
<body>

    <h2>Διαχείριση Χρηστών</h2>

    <form method="post" action="">
        <!-- Φόρμα για δημιουργία νέου χρήστη -->
        <h3>Δημιουργία Νέου Χρήστη</h3>
        <label for="new_userid">UserID:</label>
        <input type="text" name="new_userid" required>

        <label for="new_username">Username:</label>
        <input type="text" name="new_username" required>

        <label for="new_firstname">Όνομα:</label>
        <input type="text" name="new_firstname" required>

        <label for="new_lastname">Επίθετο:</label>
        <input type="text" name="new_lastname" required>

        <label for="new_email">Email:</label>
        <input type="email" name="new_email" required>

        <label for="new_country">Χώρα:</label>
        <input type="text" name="new_country" required>

        <label for="new_password">Password:</label>
        <input type="password" name="new_password" required>

        <label for="new_city">Πόλη:</label>
        <input type="text" name="new_city" required>

        <label for="new_address">Διεύθυνση:</label>
        <input type="text" name="new_address" required>

        <label for="new_Type">Τύπος χρήστη:</label>
        <select id="text" name="new_Type" required>
        <option value="Administrator">Διαχειριστής</option>
        <option value="Simple User">Απλός χρήστης</option>
        </select><br><br> 

        <input type="submit" name="create" value="Δημιουργία">
    </form>

    <h3>Λίστα Χρηστών</h3>
    <table>
        <tr>
            <th>UserID</th>
            <th>Όνομα</th>
            <th>Επίθετο</th>
            <th>Username</th>
            <th>Password</th>
            <th>Διεύθυνση</th>
            <th>Role</th>
            <th>Ενέργειες</th>
        </tr>
        <?php
        if ($usersResult->num_rows > 0) {
            while ($row = $usersResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['userid'] . "</td>";
                echo "<td>" . $row['firstname'] . "</td>";
                echo "<td>" . $row['lastname'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td><a href='update_user.php?SelectedUsername=" . $row['username'] . "'>Επεξεργασία</a> | <a href='delete_user.php?SelectedUsername=" . $row['username'] . "'>Διαγραφή</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Δεν υπάρχουν εγγραφές.</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
$conn->close();
?>
