<?php
session_start();

/*
 Hardcoded students array (for demo).
 In a real system, this data would come from a database.
*/
$students = [
    '24BCS137' => [
        'password' => '123',
        'name' => 'Malay Saha',
        'roll_no' => 'B12345',
        'hostel' => 'Hostel A',
        'room' => '101',
        'contact' => '9876543210',
        'log' => [
            ['type'=>'OUT', 'datetime'=>'02/02/2025 09:00', 'purpose'=>'Class'],
            ['type'=>'IN',  'datetime'=>'02/02/2025 11:00', 'purpose'=>'Vacation'],
            ['type'=>'OUT', 'datetime'=>'02/02/2025 14:00', 'purpose'=>'Tea'],
            ['type'=>'IN',  'datetime'=>'02/02/2025 14:30', 'purpose'=>'Back'],
        ]
    ],
    'S1001' => [
        'password' => '456',
        'name' => 'Jane Smith',
        'roll_no' => 'B12346',
        'hostel' => 'Hostel B',
        'room' => '202',
        'contact' => '9876501234',
        'log' => [
            ['type'=>'OUT', 'datetime'=>'02/02/2025 10:00', 'purpose'=>'Library'],
            ['type'=>'IN',  'datetime'=>'02/02/2025 12:00', 'purpose'=>'Return'],
            ['type'=>'OUT', 'datetime'=>'03/02/2025 09:00', 'purpose'=>'Vacation'],
        ]
    ]
];

// Get form inputs
$studentid = trim($_POST['studentid'] ?? '');
$password  = $_POST['password'] ?? '';

// Validate
if ($studentid === '' || $password === '') {
    $login_failed = true;
} elseif (isset($students[$studentid]) && $students[$studentid]['password'] === $password) {
    $_SESSION['student'] = $students[$studentid];
    $_SESSION['student']['studentid'] = $studentid;
    header("Location: student_profile.php");
    exit;
} else {
    $login_failed = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Portal - Login Result</title>

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

  --danger: #ef4444;
  --border-light: rgba(255,255,255,0.08);

  --radius-md: 10px;
  --radius-lg: 14px;

  --shadow-main: 0 8px 28px rgba(119,202,202,0.4);
}

* { box-sizing: border-box; }

body {
  margin: 0;
  min-height: 100vh;
  font-family: Inter, system-ui, Arial, sans-serif;
  background: linear-gradient(180deg, var(--bg-main), var(--bg-secondary));
  color: var(--text-primary);
}

/* Header */
header {
  display: flex;
  align-items: center;
  padding: 16px 24px;
}

.header-left,
.header-right {
  flex: 1;
}

.header-center {
  flex: 2;
  text-align: center;
}

.portal-name h1 {
  font-size: 42px;
  margin: 0;
}

.portal-name p {
  margin: 6px 0 0;
  font-size: 16px;
  color: var(--text-muted);
}

nav {
  text-align: right;
}

nav a {
  color: var(--text-primary);
  text-decoration: none;
  font-weight: 700;
  margin-left: 10px;
}

nav a:hover {
  color: var(--accent-secondary);
}

/* Output box */
.output-box {
  margin: 80px auto;
  width: 420px;
  padding: 28px;
  background: var(--bg-card);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-main);
  text-align: center;
}

.output-box.error {
  border: 2px solid var(--danger);
}

.output-box h2 {
  color: var(--danger);
  margin-bottom: 10px;
}

.output-box p {
  color: var(--text-primary);
  font-size: 15px;
}

.output-box a {
  display: inline-block;
  margin-top: 18px;
  padding: 10px 16px;
  background: linear-gradient(
    90deg,
    var(--accent-primary),
    var(--accent-secondary)
  );
  color: var(--text-dark);
  border-radius: var(--radius-md);
  text-decoration: none;
  font-weight: 700;
}

.output-box a:hover {
  opacity: 0.9;
}

/* Footer */
footer {
  text-align: center;
  margin-top: 50px;
  font-size: 14px;
  color: var(--text-muted);
}
</style>
</head>

<body>

<header>
  <div class="header-left">
    <img
      src="images/student-logo.png"
      alt="logo"
      style="height:110px;width:110px;border-radius:12px;background:#fff;padding:6px;"
    >
  </div>

  <div class="header-center portal-name">
    <h1>Student Portal</h1>
    <p>Access Your Profile & Activity Logs</p>
  </div>

  <div class="header-right">
    <nav>
      <a href="index.php">Home</a>
      <a href="student_profile.php">Profile</a>
    </nav>
  </div>
</header>

<div class="output-box error">
  <h2>❌ Login Failed</h2>
  <p>Invalid Student ID or Password.</p>
  <a href="student_login.php">Try Again</a>
</div>

<footer>
  <small>&copy; 2025 Student Portal. All Rights Reserved.</small>
</footer>

</body>
</html>
