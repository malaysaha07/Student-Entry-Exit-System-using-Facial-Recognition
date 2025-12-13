<?php
session_start();

// Admin authentication check
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
$admin = $_SESSION['admin'];
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Administration — Student Gate (Full View)</title>

  <style>
    /* ================= ROOT VARIABLES ================= */
    :root {
      --bg-main: #071126;
      --bg-secondary: #071024;
      --accent-primary: #3b82f6;
      --accent-secondary: #06b6d4;
      --text-primary: #e6eef8;
      --text-dark: #021124;
      --text-muted: #98a6bf;
      --card-bg: #27242c;
      --border-light: rgba(255, 255, 255, 0.15);
    }

    /* ================= BASE ================= */
    body {
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto,
        "Helvetica Neue", Arial;
      padding: 20px;
      min-height: 100vh;
      background: linear-gradient(180deg, var(--bg-main), var(--bg-secondary));
      color: var(--text-primary);
    }

    /* ================= HEADER ================= */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .brand h1 {
      margin: 0;
      font-size: 28px;
    }

    .brand p {
      margin: 0;
      color: var(--text-muted);
    }

    .logout-btn {
      padding: 8px 14px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      font-weight: bold;
      background: linear-gradient(90deg,
          var(--accent-primary),
          var(--accent-secondary));
      color: var(--text-dark);
    }

    /* ================= CONTROLS ================= */
    .controls {
      display: flex;
      align-items: center;
      margin: 20px 0;
      gap: 10px;
    }

    .hostel-filter button,
    .action-btn {
      padding: 8px 12px;
      border-radius: 8px;
      border: 1px solid var(--border-light);
      background: var(--card-bg);
      color: var(--text-primary);
      cursor: pointer;
    }

    .hostel-filter button.active {
      background: linear-gradient(90deg,
          var(--accent-primary),
          var(--accent-secondary));
      color: var(--text-dark);
    }

    /* ================= TABLE ================= */
    .table-wrap {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 10px;
      border-bottom: 1px solid var(--border-light);
      text-align: left;
    }

    th {
      color: var(--text-muted);
    }

    .comment-preview {
      font-size: 13px;
      margin-top: 5px;
      color: var(--text-muted);
    }

    .action-system {
      display: block;
      color: #ff6b6b;
    }

    /* ================= SUMMARY ================= */
    .summary {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
      gap: 15px;
      margin-top: 25px;
    }

    .stat {
      background: var(--card-bg);
      padding: 15px;
      border-radius: 10px;
      text-align: center;
    }

    .stat .title {
      color: var(--text-muted);
    }

    .stat .value {
      font-size: 22px;
      font-weight: bold;
    }

    /* ================= FOOTER ================= */
    footer {
      margin-top: 30px;
      text-align: center;
      color: var(--text-muted);
    }

    /* ================= MODAL ================= */
    .modal-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      display: none;
      align-items: center;
      justify-content: center;
    }

    .modal {
      background: var(--card-bg);
      padding: 20px;
      border-radius: 12px;
      width: 400px;
    }

    .modal textarea {
      width: 100%;
      height: 100px;
      margin: 10px 0;
      border-radius: 8px;
      padding: 10px;
      background: #211f1f;
      color: var(--text-primary);
      border: 1px solid var(--border-light);
    }

    .modal .row {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }

    .btn-muted,
    .btn-primary {
      padding: 8px 14px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
    }

    .btn-muted {
      background: #444;
      color: #fff;
    }

    .btn-primary {
      background: linear-gradient(90deg,
          var(--accent-primary),
          var(--accent-secondary));
      color: var(--text-dark);
    }
  </style>
</head>

<body>

  <header>
    <div class="brand">
      <div>
        <h1>Administration — Main Gate</h1>
        <p>PDPM IIITDMJ student movement logs</p>
      </div>
    </div>
    <form action="logout.php" method="post">
      <button class="logout-btn">Logout</button>
    </form>
  </header>

  <div class="controls">
    <div class="hostel-filter">
      <button data-hostel="All" class="active">All</button>
      <button data-hostel="Hostel 1">Hostel 1</button>
      <button data-hostel="Hostel 2">Hostel 2</button>
      <button data-hostel="Hostel 3">Hostel 3</button>
      <button data-hostel="Hostel 4">Hostel 4</button>
      <button data-hostel="Hostel 5">Hostel 5</button>
    </div>

    <div style="margin-left:auto">
      <button id="refresh" class="action-btn">Refresh</button>
      <button id="exportCsv" class="action-btn">Export CSV</button>
    </div>
  </div>

  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Roll</th>
          <th>Year</th>
          <th>Branch</th>
          <th>Hostel</th>
          <th>Room</th>
          <th>Phone</th>
          <th>Purpose</th>
          <th>Out Time</th>
          <th>In Time</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="log-body"></tbody>
    </table>
  </div>

  <div class="summary">
    <div class="stat">
      <div class="title">Total</div>
      <div id="total" class="value">0</div>
    </div>
    <div class="stat">
      <div class="title">IN</div>
      <div id="count-in" class="value">0</div>
    </div>
    <div class="stat">
      <div class="title">OUT</div>
      <div id="count-out" class="value">0</div>
    </div>
    <div class="stat">
      <div class="title">Hostels</div>
      <div class="value">7</div>
    </div>
  </div>

  <footer>
    © <span id="year"></span> Main Gate — Admin Panel
  </footer>

  <!-- MODAL -->
  <div class="modal-backdrop" id="modal-backdrop">
    <div class="modal">
      <h3>Add / Edit Comment</h3>
      <textarea id="comment-text"></textarea>
      <div class="row">
        <button id="modal-cancel" class="btn-muted">Cancel</button>
        <button id="modal-save" class="btn-primary">Save</button>
      </div>
    </div>
  </div>

  <!-- JS (unchanged logic, only formatted) -->
  <script>
    const STORAGE_KEY = 'studentGateLogs_v1';
    const CURFEW_HHMM = '22:30';
    const byId = id => document.getElementById(id);
    let currentFilter = 'All';
    let editingId = null;

    /* ---------- helpers ---------- */
    function formatHuman(ts) {
      if (!ts) return '';
      const d = new Date(+ts);
      return `${String(d.getHours()).padStart(2, '0')}:${String(d.getMinutes()).padStart(2, '0')},
          ${String(d.getDate()).padStart(2, '0')}/${String(d.getMonth() + 1).padStart(2, '0')}/${d.getFullYear()}`;
    }

    function isAfterCurfew(ts) {
      if (!ts) return false;
      const d = new Date(+ts);
      return `${d.getHours()}:${d.getMinutes()}` > CURFEW_HHMM;
    }

    function loadLogs() {
      return JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
    }

    function saveLogs(logs) {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(logs));
      render();
    }

    /* ---------- render ---------- */
    function render() {
      const logs = loadLogs();
      const tbody = byId('log-body');
      tbody.innerHTML = '';

      let inCount = 0, outCount = 0;

      logs
        .filter(r => currentFilter === 'All' || r.hostel === currentFilter)
        .forEach(r => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
        <td>${r.name || ''}</td>
        <td>${r.roll || ''}</td>
        <td>${r.year || ''}</td>
        <td>${r.branch || ''}</td>
        <td>${r.hostel || ''}</td>
        <td>${r.room || ''}</td>
        <td>${r.phone || ''}</td>
        <td>${r.purpose || ''}</td>
        <td>${formatHuman(r.out_ts)}</td>
        <td>${formatHuman(r.in_ts)}</td>
        <td>
          <button class="action-btn" onclick="openCommentModal('${r.id}')">Comment</button>
          <div class="comment-preview">${r.comment || ''}</div>
        </td>
      `;
          tbody.appendChild(tr);

          if (r.in_ts && (!r.out_ts || r.in_ts > r.out_ts)) inCount++;
          else if (r.out_ts) outCount++;
        });

      byId('total').textContent = logs.length;
      byId('count-in').textContent = inCount;
      byId('count-out').textContent = outCount;
    }

    /* ---------- modal ---------- */
    function openCommentModal(id) {
      editingId = id;
      const rec = loadLogs().find(r => r.id === id);
      byId('comment-text').value = rec?.comment || '';
      byId('modal-backdrop').style.display = 'flex';
    }

    byId('modal-cancel').onclick = () => byId('modal-backdrop').style.display = 'none';
    byId('modal-save').onclick = () => {
      const logs = loadLogs();
      const i = logs.findIndex(r => r.id === editingId);
      if (i !== -1) logs[i].comment = byId('comment-text').value.trim();
      saveLogs(logs);
      byId('modal-backdrop').style.display = 'none';
    };

    /* ---------- init ---------- */
    document.addEventListener('DOMContentLoaded', () => {
      byId('year').textContent = new Date().getFullYear();
      byId('refresh').onclick = render;
      byId('exportCsv').onclick = exportCsv;
      document.querySelectorAll('.hostel-filter button')
        .forEach(b => b.onclick = () => {
          currentFilter = b.dataset.hostel;
          document.querySelectorAll('.hostel-filter button')
            .forEach(x => x.classList.remove('active'));
          b.classList.add('active');
          render();
        });
      render();
    });
  </script>
</body>

</html>