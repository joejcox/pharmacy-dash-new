<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: /?error=accessdenied");
    exit();
}
?>
<h2>Welcome back, <?= $_SESSION['firstName']; ?></h2>
<a href="../customer/_logout.php">Log Out</a>