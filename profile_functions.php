<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login-form.html"); 
    exit();
}
$isAdmin = ($_SESSION['type'] == 'Administrator');

?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/profile_functions-style.css">
    <title>Κεντρικός Πίνακας</title>
    <nav>
    <a href="homepage.html">Αρχική</a> 
    </nav>
</head>
<body>
    <div class="container">
        <h2>Κεντρικός Πίνακας</h2>

        <?php if ($isAdmin): ?>
            <!-- Εμφάνιση λειτουργιών για διαχειριστή -->
            <p>Καλώς ήρθες, Διαχειριστή!</p>
            <button onclick="location.href='registration requests.php'">Διαχείριση Αιτημάτων Εγγραφής</button>
            <button onclick="location.href='add_announcements.html'">Προσθήκη Ανακοινώσεων</button>
            <button onclick="location.href='manage_users.php'">Διαχείριση στοιχείων χρηστών</button>

        <?php else: ?>
            <!-- Εμφάνιση λειτουργιών για απλό χρήστη -->
            <p>Καλώς ήρθες, Χρήστη!</p>
            <button onclick="location.href='announcements-view.php'">Προβολή Ανακοινώσεων</button>
        <?php endif; ?>

        <button onclick="location.href='logout.php'">Αποσύνδεση</button>
    </div>
</body>
</html>
