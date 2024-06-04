<?php
session_start();

// Καταστροφή όλων των στοιχείων στο session
$_SESSION = array();

// Ανακατεύθυνση στη σελίδα σύνδεσης
header("Location: login-form.html");
exit();
?>
