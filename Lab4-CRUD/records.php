<?php
session_start();

if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

$action = $_REQUEST['action'] ?? '';

switch ($action) {

    case 'insert':
        $entry = [
            'regno'      => htmlspecialchars(trim($_POST['regno'])),
            'name'       => htmlspecialchars(trim($_POST['name'])),
            'email'      => htmlspecialchars(trim($_POST['email'])),
            'department' => htmlspecialchars($_POST['department']),
            'semester'   => htmlspecialchars($_POST['semester']),
            'status'     => htmlspecialchars($_POST['status']),
        ];
        $_SESSION['students'][] = $entry;
        $_SESSION['msg']   = 'Application submitted successfully!';
        $_SESSION['mtype'] = 'success';
        header('Location: records.php');
        exit;

    case 'update':
        $idx = (int) $_POST['index'];
        if (isset($_SESSION['students'][$idx])) {
            $_SESSION['students'][$idx] = [
                'regno'      => htmlspecialchars(trim($_POST['regno'])),
                'name'       => htmlspecialchars(trim($_POST['name'])),
                'email'      => htmlspecialchars(trim($_POST['email'])),
                'department' => htmlspecialchars($_POST['department']),
                'semester'   => htmlspecialchars($_POST['semester']),
                'status'     => htmlspecialchars($_POST['status']),
            ];
            $_SESSION['msg']   = 'Record updated successfully!';
            $_SESSION['mtype'] = 'success';
        } else {
            $_SESSION['msg']   = 'Record not found.';
            $_SESSION['mtype'] = 'error';
        }
        header('Location: records.php');
        exit;

    case 'delete':
        $idx = (int) $_GET['index'];
        if (isset($_SESSION['students'][$idx])) {
            unset($_SESSION['students'][$idx]);
            $_SESSION['students'] = array_values($_SESSION['students']);
            $_SESSION['msg']   = 'Record deleted successfully.';
            $_SESSION['mtype'] = 'warn';
        } else {
            $_SESSION['msg']   = 'Record not found.';
            $_SESSION['mtype'] = 'error';
        }
        header('Location: records.php');
        exit;
}

$editIndex   = ($action === 'edit' && isset($_GET['index'])) ? (int)$_GET['index'] : -1;
$editStudent = ($editIndex >= 0 && isset($_SESSION['students'][$editIndex]))
    ? $_SESSION['students'][$editIndex] : null;

$msg   = $_SESSION['msg']   ?? '';
$mtype = $_SESSION['mtype'] ?? '';
unset($_SESSION['msg'], $_SESSION['mtype']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --ink: #0d0d0d;
  --paper: #f7f3ee;
  --accent: #c8452a;
  --muted: #8a8070;
  --border: #d6cfc5;
  --white: #fff;
  --sidebar: 240px;
}

body {
  font-family: 'DM Sans', sans-serif;
  background: var(--paper);
  display: flex;
  min-height: 100vh;
}

.sidebar {
  width: var(--sidebar);
  background: var(--ink);
  flex-shrink: 0;
  display: flex;
  flex-direction: column;
  padding: 40px 28px;
  position: fixed;
  top: 0; left: 0; bottom: 0;
  z-index: 10;
  overflow: hidden;
}
.sidebar::before {
  content: '';
  position: absolute;
  top: -100px; right: -100px;
  width: 280px; height: 280px;
  border-radius: 50%;
  border: 50px solid rgba(200,69,42,0.1);
  pointer-events: none;
}

.logo {
  font-family: 'Playfair Display', serif;
  color: var(--white);
  font-size: 22px;
  line-height: 1.25;
  position: relative;
  z-index: 1;
}
.logo-bar {
  width: 28px; height: 2px;
  background: var(--accent);
  margin-top: 10px;
}

.sidebar-nav {
  margin-top: 50px;
  flex: 1;
  position: relative; z-index: 1;
}
.nav-label {
  font-size: 10px;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.25);
  margin-bottom: 12px;
}
.nav-item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 14px;
  border-radius: 8px;
  color: rgba(255,255,255,0.6);
  text-decoration: none;
  font-size: 13px;
  font-weight: 400;
  transition: all 0.2s;
  margin-bottom: 4px;
}
.nav-item:hover, .nav-item.active {
  background: rgba(255,255,255,0.07);
  color: var(--white);
}
.nav-item.active { background: rgba(200,69,42,0.2); color: var(--accent); }
.nav-icon { font-size: 15px; width: 18px; text-align: center; }

.sidebar-footer {
  position: relative; z-index: 1;
  font-size: 11px;
  color: rgba(255,255,255,0.2);
  line-height: 1.6;
}

.main {
  margin-left: var(--sidebar);
  flex: 1;
  display: flex;
  flex-direction: column;
}

.topbar {
  background: var(--white);
  padding: 20px 36px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1px solid var(--border);
  position: sticky; top: 0; z-index: 5;
}
.topbar-title h1 {
  font-family: 'Playfair Display', serif;
  font-size: 22px;
  color: var(--ink);
}
.topbar-title p {
  font-size: 12px;
  color: var(--muted);
  margin-top: 2px;
}
.topbar-actions {
  display: flex;
  gap: 10px;
  align-items: center;
}
.count-badge {
  background: var(--paper);
  border: 1px solid var(--border);
  border-radius: 20px;
  padding: 6px 14px;
  font-size: 12px;
  color: var(--muted);
}
.count-badge strong { color: var(--ink); }
.btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 10px 18px;
  background: var(--ink);
  color: var(--white);
  border-radius: 8px;
  text-decoration: none;
  font-size: 12px;
  font-weight: 500;
  letter-spacing: 0.03em;
  transition: background 0.2s, transform 0.15s;
}
.btn-primary:hover { background: var(--accent); transform: translateY(-1px); }

.content {
  padding: 36px;
  flex: 1;
}

.stats-row {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
  margin-bottom: 30px;
}
.stat-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 14px;
  padding: 22px 24px;
  position: relative;
  overflow: hidden;
  animation: cardIn 0.4s both;
}
.stat-card:nth-child(2) { animation-delay: 0.05s; }
.stat-card:nth-child(3) { animation-delay: 0.1s; }
@keyframes cardIn {
  from { opacity: 0; transform: translateY(16px); }
  to   { opacity: 1; transform: translateY(0); }
}
.stat-card::after {
  content: '';
  position: absolute;
  top: 0; right: 0;
  width: 4px; height: 100%;
  background: var(--accent);
  opacity: 0;
  transition: opacity 0.2s;
}
.stat-card:hover::after { opacity: 1; }
.stat-label { font-size: 11px; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted); }
.stat-value { font-family: 'Playfair Display', serif; font-size: 36px; color: var(--ink); margin-top: 4px; }
.stat-sub { font-size: 11px; color: var(--muted); margin-top: 2px; font-style: italic; }

.table-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 16px;
  overflow: hidden;
  animation: cardIn 0.45s 0.15s both;
}
.table-card-header {
  padding: 18px 24px;
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.table-card-header h3 {
  font-size: 14px;
  font-weight: 500;
  color: var(--ink);
}

table {
  width: 100%;
  border-collapse: collapse;
}
thead th {
  padding: 12px 20px;
  text-align: left;
  font-size: 10px;
  font-weight: 500;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--muted);
  background: var(--paper);
  border-bottom: 1px solid var(--border);
}
tbody td {
  padding: 14px 20px;
  font-size: 13px;
  color: var(--ink);
  border-bottom: 1px solid var(--border);
  vertical-align: middle;
}
tbody tr:last-child td { border-bottom: none; }
tbody tr { transition: background 0.15s; }
tbody tr:hover { background: #faf8f5; }

.regno-cell { font-family: 'DM Sans', monospace; font-size: 11px; color: var(--muted); font-weight: 500; }
.name-cell  { font-weight: 500; }
.email-cell { color: var(--muted); font-size: 12px; }

.status-pill {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 4px 10px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 500;
}
.status-pill::before {
  content: '';
  width: 6px; height: 6px;
  border-radius: 50%;
  background: currentColor;
}
.s-active    { background: #e8f5e9; color: #2e7d32; }
.s-pending   { background: #fff3e0; color: #e65100; }
.s-graduated { background: #e3f2fd; color: #1565c0; }

.action-cell { display: flex; gap: 8px; align-items: center; }
.btn-action {
  padding: 6px 12px;
  border-radius: 6px;
  border: 1px solid var(--border);
  font-size: 11px;
  font-weight: 500;
  cursor: pointer;
  text-decoration: none;
  transition: all 0.2s;
  font-family: 'DM Sans', sans-serif;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.btn-edit   { color: #1565c0; background: #e3f2fd; border-color: #bbdefb; }
.btn-edit:hover  { background: #1565c0; color: white; border-color: #1565c0; }
.btn-delete { color: #c62828; background: #ffebee; border-color: #ffcdd2; }
.btn-delete:hover { background: #c62828; color: white; border-color: #c62828; }

.empty-state { text-align: center; padding: 60px 20px; }
.empty-state .empty-icon { font-size: 40px; opacity: 0.2; }
.empty-state p { color: var(--muted); margin-top: 12px; font-size: 14px; }

.edit-banner {
  background: var(--white);
  border: 1.5px solid var(--accent);
  border-radius: 16px;
  padding: 28px 32px;
  margin-bottom: 28px;
  animation: cardIn 0.35s both;
}
.edit-banner-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 20px;
}
.edit-banner-header h3 {
  font-family: 'Playfair Display', serif;
  font-size: 20px;
  color: var(--ink);
}
.edit-banner-header a {
  font-size: 12px;
  color: var(--muted);
  text-decoration: none;
  border: 1px solid var(--border);
  padding: 5px 12px;
  border-radius: 6px;
  transition: all 0.2s;
}
.edit-banner-header a:hover { background: var(--paper); color: var(--ink); }
.edit-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.edit-field { display: flex; flex-direction: column; gap: 5px; }
.edit-field.full { grid-column: span 2; }
.edit-field label {
  font-size: 10px;
  font-weight: 500;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--muted);
}
.edit-field input,
.edit-field select {
  padding: 10px 13px;
  border: 1.5px solid var(--border);
  border-radius: 9px;
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  color: var(--ink);
  background: var(--paper);
  outline: none;
  appearance: none;
  -webkit-appearance: none;
  transition: border-color 0.2s, box-shadow 0.2s;
}
.edit-field select {
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%238a8070' stroke-width='1.5' stroke-linecap='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 13px center;
  padding-right: 34px;
}
.edit-field input:focus,
.edit-field select:focus {
  border-color: var(--accent);
  box-shadow: 0 0 0 3px rgba(200,69,42,0.1);
  background: white;
}
.edit-actions { display: flex; gap: 10px; margin-top: 18px; }
.btn-save {
  padding: 11px 24px;
  background: var(--ink);
  color: white;
  border: none;
  border-radius: 9px;
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  font-weight: 500;
  cursor: pointer;
  transition: background 0.2s;
}
.btn-save:hover { background: var(--accent); }
.btn-cancel-edit {
  padding: 11px 20px;
  background: var(--paper);
  color: var(--ink);
  border: 1px solid var(--border);
  border-radius: 9px;
  font-family: 'DM Sans', sans-serif;
  font-size: 13px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  transition: background 0.2s;
}
.btn-cancel-edit:hover { background: var(--border); }

.toast {
  position: fixed;
  bottom: 28px; right: 28px;
  padding: 14px 20px;
  border-radius: 12px;
  display: flex; align-items: center; gap: 10px;
  font-size: 13px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.18);
  transform: translateY(80px);
  opacity: 0;
  transition: all 0.4s cubic-bezier(.22,.9,.36,1);
  z-index: 200;
  max-width: 320px;
}
.toast.show { transform: translateY(0); opacity: 1; }
.t-success { background: var(--ink); color: white; }
.t-warn    { background: #fff3e0; color: #e65100; border: 1px solid #ffe0b2; }
.t-error   { background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; }
.toast-icon { font-size: 16px; flex-shrink: 0; }
</style>
</head>
<body>

<aside class="sidebar">
  <div class="logo">KFUEIT<br>University <div class="logo-bar"></div></div>
  <nav class="sidebar-nav">
    <div class="nav-label">Navigation</div>
    <a href="records.php" class="nav-item active"><span class="nav-icon">◈</span> Dashboard</a>
    <a href="index.php"   class="nav-item"><span class="nav-icon">＋</span> Add Student</a>
  </nav>
  <div class="sidebar-footer">KFUEIT Admin Portal<br>v2.0 · 2024</div>
</aside>

<div class="main">

  <div class="topbar">
    <div class="topbar-title">
      <h1>Student Management</h1>
      <p>Manage and monitor all enrolled students</p>
    </div>
    <div class="topbar-actions">
      <div class="count-badge">Total: <strong><?= count($_SESSION['students']) ?></strong></div>
      <a href="index.php" class="btn-primary">＋ Add Student</a>
    </div>
  </div>

  <div class="content">

    <?php
      $active    = count(array_filter($_SESSION['students'], fn($s) => strtolower($s['status']) === 'active'));
      $pending   = count(array_filter($_SESSION['students'], fn($s) => strtolower($s['status']) === 'pending'));
      $graduated = count(array_filter($_SESSION['students'], fn($s) => strtolower($s['status']) === 'graduated'));
    ?>

    <div class="stats-row">
      <div class="stat-card">
        <div class="stat-label">Total Students</div>
        <div class="stat-value"><?= count($_SESSION['students']) ?></div>
        <div class="stat-sub">All records</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Active</div>
        <div class="stat-value"><?= $active ?></div>
        <div class="stat-sub"><?= $pending ?> pending</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Graduated</div>
        <div class="stat-value"><?= $graduated ?></div>
        <div class="stat-sub">Alumni</div>
      </div>
    </div>

    <?php if ($editStudent): ?>
    <div class="edit-banner">
      <div class="edit-banner-header">
        <h3>Editing Record #<?= $editIndex ?></h3>
        <a href="records.php">✕ Cancel</a>
      </div>
      <form action="records.php?action=update" method="post">
        <input type="hidden" name="index" value="<?= $editIndex ?>">
        <div class="edit-grid">
          <div class="edit-field">
            <label>Registration No.</label>
            <input type="text" name="regno" value="<?= $editStudent['regno'] ?>" required>
          </div>
          <div class="edit-field">
            <label>Full Name</label>
            <input type="text" name="name" value="<?= $editStudent['name'] ?>" required>
          </div>
          <div class="edit-field full">
            <label>Email</label>
            <input type="email" name="email" value="<?= $editStudent['email'] ?>" required>
          </div>
          <div class="edit-field">
            <label>Department</label>
            <select name="department" required>
              <?php foreach(['Computer Science','Information Technology','Business Management','Biotechnology'] as $d): ?>
              <option <?= $editStudent['department'] === $d ? 'selected' : '' ?>><?= $d ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="edit-field">
            <label>Semester</label>
            <select name="semester" required>
              <?php for($i=1;$i<=8;$i++): ?>
              <option <?= $editStudent['semester'] == $i ? 'selected' : '' ?>><?= $i ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <div class="edit-field full">
            <label>Status</label>
            <select name="status" required>
              <?php foreach(['Active','Pending','Graduated'] as $st): ?>
              <option <?= $editStudent['status'] === $st ? 'selected' : '' ?>><?= $st ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="edit-actions">
          <a href="records.php" class="btn-cancel-edit">Cancel</a>
          <button type="submit" class="btn-save">Save Changes →</button>
        </div>
      </form>
    </div>
    <?php endif; ?>

    <div class="table-card">
      <div class="table-card-header">
        <h3>All Students</h3>
      </div>
      <table>
        <thead>
          <tr>
            <th>Reg No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Sem</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if(empty($_SESSION['students'])): ?>
          <tr>
            <td colspan="7">
              <div class="empty-state">
                <div class="empty-icon">◈</div>
                <p>No students found. Add your first student record.</p>
              </div>
            </td>
          </tr>
          <?php else: foreach($_SESSION['students'] as $i => $s):
            $sc = 's-' . strtolower($s['status']);
          ?>
          <tr>
            <td class="regno-cell"><?= $s['regno'] ?></td>
            <td class="name-cell"><?= $s['name'] ?></td>
            <td class="email-cell"><?= $s['email'] ?></td>
            <td><?= $s['department'] ?></td>
            <td><?= $s['semester'] ?></td>
            <td><span class="status-pill <?= $sc ?>"><?= $s['status'] ?></span></td>
            <td>
              <div class="action-cell">
                <a class="btn-action btn-edit"
                   href="records.php?action=edit&index=<?= $i ?>">
                  ✎ Edit
                </a>
                <a class="btn-action btn-delete"
                   href="records.php?action=delete&index=<?= $i ?>"
                   onclick="return confirm('Delete this record?')">
                  ✕ Delete
                </a>
              </div>
            </td>
          </tr>
          <?php endforeach; endif; ?>
        </tbody>
      </table>
    </div>

  </div>
</div>

<?php if($msg): ?>
<div class="toast t-<?= $mtype ?> show" id="toast">
  <span class="toast-icon"><?= $mtype === 'success' ? '✓' : ($mtype === 'warn' ? '⚠' : '✕') ?></span>
  <?= htmlspecialchars($msg) ?>
</div>
<script>
  setTimeout(() => {
    const t = document.getElementById('toast');
    if(t) t.classList.remove('show');
  }, 3500);
</script>
<?php endif; ?>

</body>
</html>