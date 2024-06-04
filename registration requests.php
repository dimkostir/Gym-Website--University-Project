<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Διαχείριση Αιτημάτων Εγγραφής</title>
    <link rel="stylesheet" type="text/css" href="CSS/reg requests.css"> 
    <nav>
    <a href="homepage.html">Αρχική</a> 
    </nav>
</head>
<body>

    <h2>Διαχείριση Αιτημάτων Εγγραφής</h2>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "gym_ergasia";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Αποτυχία σύνδεσης στη βάση δεδομένων: " . $conn->connect_error);
    }


    $selectAllUsersQuery = "SELECT * FROM users";
    $result = $conn->query($selectAllUsersQuery);

    if ($result->num_rows > 0) {
        echo "<form method='post' action='process_approval.php'>";
        echo "<table>";
        echo "<tr><th>UserID</th><th>Username</th><th>Password</th><th>Email</th><th>Type</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['userid'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>"  .$row['type'] . "</td>";
            echo "<td><input type='hidden' name='selectedUsername' value='" . $row['username'] . "'><input type='submit' name='approve' value='Έγκριση'></td>";
            echo "<td><input type='hidden' name='selectedUsername' value='" . $row['username'] . "'><input type='submit' name='reject' value='Απόρριψη'></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Δεν υπάρχουν εγγραφές στον πίνακα.</p>";
    }

    $conn->close();
    ?>

</body>
</html>
