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
    if(isset($_POST['title']) && isset($_POST['content']))
    {
    //δεδομένα από τη φόρμα
    $title = $_POST["title"];
    $content = $_POST["content"];

 
    $sql = "INSERT INTO announcements (title, content, users_userid) VALUES ('$title', '$content',1)";

    if ($conn->query($sql) === TRUE) {
        echo "Η ανακοίνωση προστέθηκε με επιτυχία!";
    } else {
        echo "Σφάλμα κατά την προσθήκη ανακοίνωσης: " . $conn->error;
    }
}
}

$conn->close();
?>
