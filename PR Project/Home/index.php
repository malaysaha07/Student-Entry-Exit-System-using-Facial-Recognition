<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PDPM IIITDMJ | Student Entry–Exit Portal</title>

  <style>
    :root {
      --bg-main: #071126;
      --bg-card: #121b33;
      --primary: #3b82f6;
      --secondary: #06b6d4;
      --text-main: #e6eef8;
      --text-muted: #9aa8c7;
      --border: rgba(255, 255, 255, 0.12);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial;
      background: linear-gradient(180deg, #050c1d, var(--bg-main));
      color: var(--text-main);
      line-height: 1.6;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 18px 40px;
      border-bottom: 1px solid var(--border);
    }

    .logo {
      font-size: 22px;
      font-weight: 700;
      color: var(--primary);
    }

    nav a {
      color: var(--text-main);
      text-decoration: none;
      margin-left: 24px;
      font-size: 15px;
    }

    nav a:hover {
      color: var(--secondary);
    }

    .hero {
      padding: 80px 40px;
      text-align: center;
    }

    .hero h1 {
      font-size: 44px;
      margin-bottom: 16px;
    }

    .hero p {
      font-size: 18px;
      color: var(--text-muted);
      max-width: 750px;
      margin: auto;
    }

    section {
      padding: 70px 40px;
    }

    .section-title {
      text-align: center;
      font-size: 32px;
      margin-bottom: 14px;
    }

    .section-desc {
      text-align: center;
      color: var(--text-muted);
      margin-bottom: 48px;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 24px;
      max-width: 1100px;
      margin: auto;
    }

    .card {
      background: var(--bg-card);
      padding: 28px;
      border-radius: 14px;
      border: 1px solid var(--border);
    }

    .card h3 {
      margin-bottom: 10px;
      color: var(--secondary);
    }

    .card p {
      color: var(--text-muted);
      font-size: 15px;
    }

    /* SUMMARY */
    .summary-box {
      max-width: 900px;
      margin: auto;
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 30px;
    }

    .summary-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .timestamp {
      font-size: 14px;
      color: var(--text-muted);
    }

    .summary-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 18px;
    }

    .summary-item {
      padding: 18px;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.03);
      border: 1px solid var(--border);
      text-align: center;
    }

    .summary-item h3 {
      font-size: 26px;
      color: var(--primary);
      margin-bottom: 6px;
    }

    .summary-item p {
      font-size: 14px;
      color: var(--text-muted);
    }

    .rules {
      max-width: 900px;
      margin: auto;
    }

    .rules ul {
      list-style: none;
    }

    .rules li {
      margin-bottom: 12px;
      padding-left: 16px;
      position: relative;
      color: var(--text-muted);
    }

    .rules li::before {
      content: "•";
      position: absolute;
      left: 0;
      color: var(--primary);
    }

    footer {
      border-top: 1px solid var(--border);
      padding: 30px 40px;
      text-align: center;
      font-size: 14px;
      color: var(--text-muted);
    }
  </style>
</head>

<body>

  <header>
    <div class="logo">PDPM IIITDMJ Entry–Exit Portal</div>
    <nav>
      <a href="/PHP\PR Project\Home\index.php">Home</a>
      <a href="\PHP\PR Project\Student\student_login.php">Student Login</a>
      <a href="/PHP/PR Project/Hostel/login.php">Hostel Login</a>
      <a href="/PHP\PR Project\Admin\login.php">Admin Login</a>
      <a href="#">Rules</a>
      <a href="#">Contact</a>
    </nav>
  </header>

  <div class="hero">
    <h1>PDPM IIITDMJ Student Entry–Exit Management System</h1>
    <p>
      A secure digital platform to record, monitor, and manage student movement
      across the PDPM IIITDMJ campus with real-time access for administration and guards.
    </p>
  </div>

  <!-- SUMMARY -->
  <section>
    <h2 class="section-title">Summary</h2>
    <p class="section-desc">Quick overview of current entry–exit status</p>

    <div class="summary-box">
      <div class="summary-header">
        <strong>Quick Stats</strong>
        <div class="timestamp" id="currentTime"></div>
      </div>

      <div class="summary-grid">
        <div class="summary-item">
          <h3>2</h3>
          <p>Total Records</p>
        </div>

        <div class="summary-item">
          <h3>2</h3>
          <p>Inside (IN)</p>
        </div>

        <div class="summary-item">
          <h3>0</h3>
          <p>Outside (OUT)</p>
        </div>

        <div class="summary-item">
          <h3>7</h3>
          <p>Hostels</p>
        </div>
      </div>
    </div>
  </section>

  <section>
    <h2 class="section-title">About the System</h2>
    <p class="section-desc">
      A centralized digital solution for PDPM IIITDMJ to ensure campus safety and accountability.
    </p>

    <div class="card-grid">
      <div class="card">
        <h3>Digital Logging</h3>
        <p>Automatic date and time–stamped entry–exit records for every student.</p>
      </div>

      <div class="card">
        <h3>Role-Based Access</h3>
        <p>Separate dashboards for students, administration, wardens, and guards.</p>
      </div>

      <div class="card">
        <h3>Enhanced Campus Monitoring</h3>
        <p>Guards can verify student movement at campus gates.</p>
      </div>
    </div>
  </section>

  <section>
    <h2 class="section-title">Basic Rules & Guidelines</h2>

    <div class="rules">
      <ul>
        <li>All students must log exit and entry through the portal.</li>
        <li>Guards will verify records at entry and exit points.</li>
        <li>Providing false information may lead to disciplinary action.</li>
        <li>Emergency movements must be reported to wardens or guards.</li>
        <li>Portal access is restricted to authorized PDPM IIITDMJ personnel only.</li>
      </ul>
    </div>
  </section>

  <footer>
    © 2025 PDPM Indian Institute of Information Technology, Design and Manufacturing, Jabalpur
    <br />
    Student Entry–Exit Management System | Campus Safety Initiative
  </footer>

  <script>
    function updateTime() {
      const now = new Date();
      const pad = n => n.toString().padStart(2, '0');

      const date =
        pad(now.getDate()) + '-' +
        pad(now.getMonth() + 1) + '-' +
        now.getFullYear();

      const time =
        pad(now.getHours()) + ':' +
        pad(now.getMinutes()) + ':' +
        pad(now.getSeconds());

      document.getElementById('currentTime').textContent =
        date + ' ' + time;
    }

    updateTime();
    setInterval(updateTime, 1000);
  </script>

</body>

</html>