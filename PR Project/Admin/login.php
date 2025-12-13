<?php
session_start();

if (isset($_POST['login'])) {
    $users = [
        'director' => ['password' => 'director123', 'level' => 'Director'],
        'dean'     => ['password' => 'dean123',     'level' => 'Dean Academic'],
        'guard'    => ['password' => 'guard123',    'level' => 'Guard']
    ];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $level    = $_POST['level'];

    if (isset($users[$username])) {
        if ($users[$username]['password'] === $password && $users[$username]['level'] === $level) {
            $_SESSION['admin'] = [
                'username' => $username,
                'level'    => $level
            ];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Incorrect password or access level.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration Login</title>

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

  --danger: #ef4444;
  --border-light: rgba(255,255,255,0.08);

  --radius-sm: 6px;
  --radius-md: 10px;
  --radius-lg: 14px;

  --shadow-main: 0 8px 28px rgba(119,202,202,0.4);
}

* {
  box-sizing: border-box;
}

body {
  margin: 0;
  min-height: 100vh;
  font-family: Inter, system-ui, Arial, sans-serif;
  background: linear-gradient(180deg, var(--bg-main), var(--bg-secondary));
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--text-primary);
}

.login-container {
  width: 380px;
  padding: 28px;
  background: var(--bg-card);
  border-radius: var(--radius-lg);
  border: 1px solid var(--border-light);
  box-shadow: var(--shadow-main);
}

.login-container h2 {
  text-align: center;
  margin-bottom: 20px;
  color: var(--accent-secondary);
  font-weight: 700;
}

.error {
  background: rgba(239,68,68,0.15);
  color: var(--danger);
  padding: 10px;
  border-radius: var(--radius-sm);
  text-align: center;
  margin-bottom: 14px;
  font-size: 14px;
}

.login-container input,
.login-container select {
  width: 100%;
  padding: 11px;
  margin-bottom: 14px;
  border-radius: var(--radius-md);
  border: 1px solid var(--border-light);
  background: var(--bg-input);
  color: var(--text-primary);
  font-size: 14px;
}

.login-container input::placeholder {
  color: var(--text-muted);
}

.login-container select {
  cursor: pointer;
}

.login-container button {
  width: 100%;
  padding: 11px;
  font-size: 15px;
  font-weight: 700;
  border-radius: var(--radius-md);
  border: none;
  cursor: pointer;
  background: linear-gradient(
    90deg,
    var(--accent-primary),
    var(--accent-secondary)
  );
  color: var(--text-dark);
}

.login-container button:hover {
  opacity: 0.9;
}
</style>
</head>

<body>

<div class="login-container">
  <h2>Administration Login</h2>

  <?php if (isset($error)) { ?>
    <div class="error"><?php echo htmlspecialchars($error); ?></div>
  <?php } ?>

  <form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>

    <select name="level" required>
      <option value="">Select Access Level</option>
      <option value="Director">Director</option>
      <option value="Dean Academic">Dean Academic</option>
      <option value="Guard">Guard</option>
    </select>

    <button type="submit" name="login">Login</button>
  </form>
</div>

</body>
</html>
