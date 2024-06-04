<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/announcements-view-style.css">
    <title>Προβολή Ανακοινώσεων</title>
    <nav>
    <a href="homepage.html">Αρχική</a> 
    </nav>
</head>
<body>
    <div class="container">
        <h2>Ανακοινώσεις</h2>

        <?php
        // Σύνδεση στη βάση δεδομένων
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "gym_ergasia";

        $conn = new mysqli($servername, $username, $password, $database);

        // Έλεγχος σύνδεσης
        if ($conn->connect_error) {
            die("Αποτυχία σύνδεσης στη βάση δεδομένων: " . $conn->connect_error);
        }

        // Εκτέλεση ερωτήματος για ανάκτηση ανακοινώσεων
        $sql = "SELECT * FROM announcements";
        $result = $conn->query($sql);

        // Εμφάνιση ανακοινώσεων
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='announcement'>";
                echo "<h3>" . $row['title'] . "</h3>";
                echo "<p>" . $row['content'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>Δεν υπάρχουν διαθέσιμες ανακοινώσεις.</p>";
        }

        // Κλείσιμο σύνδεσης με τη βάση δεδομένων
        $conn->close();
        ?>

    </div>
</body>
</html>
