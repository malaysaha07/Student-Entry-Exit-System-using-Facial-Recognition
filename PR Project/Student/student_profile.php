<?php
session_start();
if (!isset($_SESSION['student'])) {
    header("Location: index.php");
    exit;
}

$student = $_SESSION['student'];
$log = $student['log'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Profile</title>

<style>
:root {
  --bg-main: #071126;
  --bg-secondary: #071024;
  --bg-card: #27242c;
  --bg-input: #211f1f;

  --accent-primary: #3b82f6;
  --accent-secondary: #06b6d4;

  --text-primary: #e6eef8;
  --text-muted: #98a6bf;
  --text-dark: #021124;

  --success: #10b981;
  --danger: #ef4444;
  --warning: #f59e0b;

  --border-light: rgba(255,255,255,0.08);

  --radius-sm: 6px;
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
header.app-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 14px 22px;
  border-bottom: 1px solid var(--border-light);
}

.header-left {
  display: flex;
  align-items: center;
  gap: 14px;
}

.portal-name h1 {
  font-size: 24px;
  margin: 0;
}

.portal-name p {
  margin: 0;
  font-size: 13px;
  color: var(--text-muted);
}

/* Buttons */
.header-buttons {
  display: flex;
  gap: 10px;
}

.btn {
  padding: 9px 14px;
  border-radius: var(--radius-md);
  font-weight: 700;
  text-decoration: none;
  border: none;
  cursor: pointer;
  font-size: 14px;
}

.btn.edit {
  background: linear-gradient(
    90deg,
    var(--accent-primary),
    var(--accent-secondary)
  );
  color: var(--text-dark);
}

.btn.logout {
  background: transparent;
  border: 1px solid var(--danger);
  color: var(--danger);
}

.btn:hover { opacity: 0.9; }

/* Profile Card */
.profile {
  max-width: 950px;
  margin: 30px auto;
  background: var(--bg-card);
  padding: 24px;
  border-radius: var(--radius-lg);
  border: 1px solid var(--border-light);
  box-shadow: var(--shadow-main);
}

.profile h1,
.profile h2 {
  color: var(--accent-secondary);
  margin-bottom: 10px;
}

.profile h3 {
  margin: 6px 0;
}

.profile p {
  margin: 6px 0;
  font-size: 15px;
  color: var(--text-primary);
}

/* Tables */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 14px;
  font-size: 14px;
}

th, td {
  padding: 10px;
  text-align: center;
}

th {
  background: linear-gradient(
    90deg,
    var(--accent-primary),
    var(--accent-secondary)
  );
  color: var(--text-dark);
  font-weight: 700;
}

tbody tr {
  border-top: 1px solid var(--border-light);
}

tr.out-row {
  background: rgba(239,68,68,0.12);
  color: var(--danger);
}

tr.in-row {
  background: rgba(16,185,129,0.12);
  color: var(--success);
}

tr.vacation-row {
  background: rgba(245,158,11,0.15);
  color: var(--warning);
  font-weight: 700;
}

tr.spacer-row td {
  border: none;
  height: 10px;
  background: transparent;
}

/* Footer */
footer.page-footer {
  text-align: center;
  margin: 30px 0 60px;
  color: var(--text-muted);
  font-size: 13px;
}

/* Responsive */
@media (max-width: 640px) {
  .portal-name h1 { font-size: 18px; }
  .profile { margin: 16px; padding: 16px; }
  table th, table td { font-size: 13px; padding: 8px; }
}
</style>
</head>

<body>

<header class="app-header">
  <div class="header-left">
    <img
      src="images/student-logo.png"
      alt="logo"
      style="width:70px;height:70px;border-radius:10px;background:#fff;padding:6px;"
    >
    <div class="portal-name">
      <h1>Student Portal</h1>
      <p>Access Your Profile & Activity Logs</p>
    </div>
  </div>

  <div class="header-buttons">
    <a href="edit_profile.php" class="btn edit">Edit Profile</a>
    <form method="post" action="logout.php" onsubmit="return confirm('Logout now?');" style="margin:0;">
      <button type="submit" class="btn logout">Logout</button>
    </form>
  </div>
</header>

<div class="profile">

  <h1>Student Details</h1>
  <h3>Name: <?php echo htmlspecialchars($student['name'] ?? ''); ?></h3>
  <p><strong>Roll No:</strong> <?php echo htmlspecialchars($student['roll_no'] ?? ''); ?></p>
  <p><strong>Hostel:</strong> <?php echo htmlspecialchars($student['hostel'] ?? ''); ?></p>
  <p><strong>Room No:</strong> <?php echo htmlspecialchars($student['room'] ?? ''); ?></p>
  <p><strong>Contact:</strong> <?php echo htmlspecialchars($student['contact'] ?? ''); ?></p>

  <h2>Movement Log</h2>
  <table>
    <tr>
      <th>Type</th>
      <th>Date</th>
      <th>Time</th>
      <th>Purpose</th>
    </tr>

    <?php
    $i = 0;
    foreach ($log as $entry):
        $parts = explode(' ', $entry['datetime'], 2);
        $date = $parts[0] ?? '';
        $time = $parts[1] ?? '';
        $type = strtolower($entry['type'] ?? '');
        $purpose = strtolower(trim($entry['purpose'] ?? ''));

        if ($purpose === 'vacation') continue;

        $rowClass = ($type === 'out') ? 'out-row' : (($type === 'in') ? 'in-row' : '');
    ?>
      <tr class="<?php echo $rowClass; ?>">
        <td><?php echo htmlspecialchars($entry['type']); ?></td>
        <td><?php echo htmlspecialchars($date); ?></td>
        <td><?php echo htmlspecialchars($time); ?></td>
        <td><?php echo htmlspecialchars($entry['purpose']); ?></td>
      </tr>
    <?php
      $i++;
      if ($i % 2 == 0) {
        echo '<tr class="spacer-row"><td colspan="4"></td></tr>';
      }
    endforeach;
    ?>
  </table>

  <h2>Vacation Log</h2>
  <table>
    <tr>
      <th>Type</th>
      <th>Date</th>
      <th>Time</th>
      <th>Purpose</th>
    </tr>

    <?php
    $hasVacation = false;
    foreach ($log as $entry):
        $parts = explode(' ', $entry['datetime'], 2);
        $date = $parts[0] ?? '';
        $time = $parts[1] ?? '';
        $purpose = strtolower(trim($entry['purpose'] ?? ''));

        if ($purpose === 'vacation') {
            $hasVacation = true;
            echo '<tr class="vacation-row">';
            echo '<td>' . htmlspecialchars($entry['type']) . '</td>';
            echo '<td>' . htmlspecialchars($date) . '</td>';
            echo '<td>' . htmlspecialchars($time) . '</td>';
            echo '<td>' . htmlspecialchars($entry['purpose']) . '</td>';
            echo '</tr>';
        }
    endforeach;

    if (!$hasVacation) {
        echo '<tr><td colspan="4">No vacation records found.</td></tr>';
    }
    ?>
  </table>

</div>

<footer class="page-footer">
  <small>&copy; 2025 Student Portal. All Rights Reserved.</small>
</footer>

</body>
</html>
