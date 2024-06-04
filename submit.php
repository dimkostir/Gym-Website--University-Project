
<?php
//υλοποίηση της εγγραφής περνώντας τα στοιχεία απο την φόρμα στην βάση δεδομένων
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "gym_ergasia";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Αποτυχία σύνδεσης στη βάση δεδομένων: " . $conn->connect_error);
}


$result = $conn->query("SELECT COUNT(*) AS count FROM users");
$row = $result->fetch_assoc();
$count = $row['count'];

$message = "Επιτυχής εγγραφή!";

$new_id = ($count > 0) ? ($count + 1) : 1;

if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
    if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['country']) && isset($_POST['city']) && isset($_POST['address']) && isset($_POST['type']))
    {
        $name = $_POST["firstname"];
        $surname = $_POST["lastname"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $country = $_POST["country"];
        $city = $_POST["city"];
        $address = $_POST["address"];
        $type = $_POST["type"];

            // Έλεγχος αν το username υπάρχει ήδη
        $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
        $resultUsername = $conn->query($checkUsernameQuery);

        if ($resultUsername->num_rows > 0) {
        echo "Το username υπάρχει ήδη. Παρακαλώ επιλέξτε ένα άλλο.";
        } else {
        // Έλεγχος αν το email υπάρχει ήδη
        $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
        $resultEmail = $conn->query($checkEmailQuery);
        }
        if ($resultEmail->num_rows > 0) {
            echo "Το email υπάρχει ήδη. Παρακαλώ εισαγάγετε ένα άλλο email.";
        } else{


        $sql = "INSERT INTO users (userid,firstname, lastname, email, username, password, country, city, address, type) 
        VALUES ('$new_id','$name', '$surname', '$email', '$username', '$password', '$country', '$city', '$address', '$type')";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Η εγγραφή πραγματοποιήθηκε με επιτυχία!";
        } 
        else {
            echo "Σφάλμα κατά την εγγραφή στη βάση δεδομένων: " . $conn->error;
        }
    }
    else {
        echo "Δεν υποβλήθηκαν όλα τα απαραίτητα πεδία της φόρμας.";
    }
}
header("Location: homepage.html");
exit();


$conn->close();
?>