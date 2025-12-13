<?php
session_start();

// Check if form is submitted
if (isset($_POST['login'])) {
    $users = [
        'warden'    => ['password' => 'warden123',    'role' => 'Warden'],
        'assistant' => ['password' => 'assistant123', 'role' => 'Assistant Warden'],
        'security'  => ['password' => 'security123',  'role' => 'Security Staff']
    ];

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $role     = $_POST['role'] ?? '';

    if (isset($users[$username])) {
        if ($users[$username]['password'] === $password && $users[$username]['role'] === $role) {
            $_SESSION['hostel'] = [
                'username' => $username,
                'role'     => $role
            ];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Incorrect password or role.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hostel Login</title>

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

.page-wrapper {
  width: 100%;
  display: flex;
  justify-content: center;
}

.login-container {
  width: 400px;
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

.btn-row {
  display: flex;
  gap: 10px;
  margin-top: 10px;
}

.reset-btn,
.login-btn {
  flex: 1;
  padding: 11px;
  font-size: 14px;
  font-weight: 700;
  border-radius: var(--radius-md);
  border: none;
  cursor: pointer;
}

.reset-btn {
  background: transparent;
  border: 1px solid var(--border-light);
  color: var(--text-muted);
}

.reset-btn:hover {
  background: rgba(255,255,255,0.05);
}

.login-btn {
  background: linear-gradient(
    90deg,
    var(--accent-primary),
    var(--accent-secondary)
  );
  color: var(--text-dark);
}

.login-btn:hover {
  opacity: 0.9;
}
</style>
</head>

<body>

<div class="page-wrapper">
  <div class="login-container">
    <h2>Hostel Login</h2>

    <?php if (isset($error)) : ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
      <input
        type="text"
        name="username"
        placeholder="Username"
        required
        value="<?php echo htmlspecialchars($username ?? ''); ?>"
      >

      <input type="password" name="password" placeholder="Password" required>

      <select name="role" required>
        <option value="">Select Role</option>
        <option value="Warden" <?php if (($role ?? '') === 'Warden') echo 'selected'; ?>>Warden</option>
        <option value="Assistant Warden" <?php if (($role ?? '') === 'Assistant Warden') echo 'selected'; ?>>Assistant Warden</option>
        <option value="Security Staff" <?php if (($role ?? '') === 'Security Staff') echo 'selected'; ?>>Security Staff</option>
      </select>

      <div class="btn-row">
        <button type="reset" class="reset-btn" id="resetBtn">Reset</button>
        <button type="submit" name="login" class="login-btn">Login</button>
      </div>
    </form>
  </div>
</div>

<script>
document.getElementById('resetBtn').addEventListener('click', function () {
  const err = document.querySelector('.error');
  if (err) err.remove();
});
</script>

</body>
</html>
