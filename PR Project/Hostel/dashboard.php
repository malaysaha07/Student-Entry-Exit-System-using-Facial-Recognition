<?php
session_start();
if (!isset($_SESSION['hostel'])) {
    header("Location: login.php");
    exit;
}

$hostel = $_SESSION['hostel'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hostel Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dashboard-container">
    <h1>Welcome, <?php echo htmlspecialchars($hostel['username']); ?>!</h1>
    <p>Your role: <?php echo htmlspecialchars($hostel['role']); ?></p>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

</body>
</html>
