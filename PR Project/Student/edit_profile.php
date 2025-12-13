<?php
session_start();
if (!isset($_SESSION['student'])) {
    header("Location: index.php");
    exit;
}

$student = $_SESSION['student'];
$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name   = trim($_POST['name']);
    $phone  = trim($_POST['phone']);
    $hostel = trim($_POST['hostel']);
    $room   = trim($_POST['room']);

    if ($name === "" || $phone === "") {
        $error = "Name and phone number are required.";
    } else {
        $_SESSION['student']['name']   = $name;
$_SESSION['student']['phone']  = $phone;
$_SESSION['student']['hostel'] = $hostel;
$_SESSION['student']['room']   = $room;

/* Redirect to profile page */
header("Location: student_profile.php?updated=1");
exit;

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Profile</title>

<style>
:root {
  --bg-main: #071126;
  --bg-secondary: #071024;
  --bg-card: #27242c;
  --accent-primary: #3b82f6;
  --accent-secondary: #06b6d4;
  --text-primary: #e6eef8;
  --text-muted: #98a6bf;
  --text-dark: #021124;
  --border-light: rgba(255,255,255,0.08);
  --radius-md: 10px;
  --radius-lg: 14px;
  --shadow-main: 0 10px 30px rgba(0,0,0,0.4);
}

* { box-sizing: border-box; }

body {
  margin: 0;
  min-height: 100vh;
  padding: 20px;
  font-family: Inter, system-ui, Arial, sans-serif;
  background: linear-gradient(180deg, var(--bg-main), var(--bg-secondary));
  color: var(--text-primary);
}

.card {
  max-width: 760px;
  margin: 50px auto;
  background: var(--bg-card);
  padding: 28px;
  border-radius: var(--radius-lg);
  border: 1px solid var(--border-light);
  box-shadow: var(--shadow-main);
}

h1 {
  margin: 0 0 18px;
  color: var(--accent-secondary);
}

.form-group {
  margin-bottom: 16px;
}

label {
  display: block;
  margin-bottom: 6px;
  font-size: 14px;
  color: var(--text-muted);
}

input {
  width: 100%;
  padding: 10px 12px;
  border-radius: var(--radius-md);
  border: 1px solid var(--border-light);
  background: #0b1b33;
  color: var(--text-primary);
  font-size: 15px;
}

input:focus {
  outline: none;
  border-color: var(--accent-secondary);
}

.alert {
  margin-bottom: 16px;
  padding: 10px 14px;
  border-radius: var(--radius-md);
  font-size: 14px;
}

.alert-success {
  background: rgba(6,182,212,0.15);
  color: var(--accent-secondary);
}

.alert-error {
  background: rgba(239,68,68,0.15);
  color: #f87171;
}

.actions {
  display: flex;
  gap: 12px;
  margin-top: 20px;
}

.btn {
  padding: 10px 18px;
  border-radius: var(--radius-md);
  text-decoration: none;
  font-weight: 700;
  border: none;
  cursor: pointer;
}

.btn-primary {
  background: linear-gradient(90deg, var(--accent-primary), var(--accent-secondary));
  color: var(--text-dark);
}

.btn-secondary {
  background: transparent;
  color: var(--text-primary);
  border: 1px solid var(--border-light);
}

.btn:hover {
  opacity: 0.9;
}
</style>
</head>

<body>

<div class="card">
  <h1>Edit Profile</h1>

  <?php if ($success): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
  <?php endif; ?>

  <?php if ($error): ?>
    <div class="alert alert-error"><?php echo $error; ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="form-group">
      <label>Student Name</label>
      <input type="text" name="name" value="<?php echo htmlspecialchars($student['name'] ?? ''); ?>">
    </div>

    <div class="form-group">
      <label>Phone Number</label>
      <input type="text" name="phone" value="<?php echo htmlspecialchars($student['phone'] ?? ''); ?>">
    </div>

    <div class="form-group">
      <label>Hostel</label>
      <input type="text" name="hostel" value="<?php echo htmlspecialchars($student['hostel'] ?? ''); ?>">
    </div>

    <div class="form-group">
      <label>Room Number</label>
      <input type="text" name="room" value="<?php echo htmlspecialchars($student['room'] ?? ''); ?>">
    </div>

    <div class="actions">
      <button class="btn btn-primary" type="submit">Save Changes</button>
      <a class="btn btn-secondary" href="student_profile.php">Cancel</a>
    </div>
  </form>
</div>

</body>
</html>
