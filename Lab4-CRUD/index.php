<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admission Portal</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --ink: #0d0d0d;
  --paper: #f7f3ee;
  --accent: #c8452a;
  --muted: #8a8070;
  --border: #d6cfc5;
  --white: #fff;
}

body {
  font-family: 'DM Sans', sans-serif;
  background: var(--paper);
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
}

body::before {
  content: '';
  position: fixed;
  top: -200px; right: -200px;
  width: 600px; height: 600px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(200,69,42,0.08) 0%, transparent 70%);
  pointer-events: none;
}
body::after {
  content: '';
  position: fixed;
  bottom: -150px; left: -150px;
  width: 500px; height: 500px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(13,13,13,0.05) 0%, transparent 70%);
  pointer-events: none;
}

.page-wrap {
  display: flex;
  gap: 0;
  width: 900px;
  max-width: 95vw;
  box-shadow: 0 30px 80px rgba(0,0,0,0.15);
  border-radius: 20px;
  overflow: hidden;
  animation: rise 0.6s cubic-bezier(.22,.9,.36,1) both;
}

@keyframes rise {
  from { opacity: 0; transform: translateY(30px); }
  to   { opacity: 1; transform: translateY(0); }
}

.side-panel {
  background: var(--ink);
  width: 280px;
  flex-shrink: 0;
  padding: 50px 35px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  position: relative;
  overflow: hidden;
}
.side-panel::before {
  content: '';
  position: absolute;
  top: -80px; right: -80px;
  width: 260px; height: 260px;
  border-radius: 50%;
  border: 40px solid rgba(200,69,42,0.15);
}
.side-panel::after {
  content: '';
  position: absolute;
  bottom: 40px; left: -60px;
  width: 180px; height: 180px;
  border-radius: 50%;
  border: 30px solid rgba(255,255,255,0.04);
}

.side-logo {
  font-family: 'Playfair Display', serif;
  color: var(--white);
  font-size: 28px;
  line-height: 1.2;
  position: relative;
  z-index: 1;
}
.side-logo span {
  display: block;
  width: 32px; height: 3px;
  background: var(--accent);
  margin-top: 12px;
}

.side-info {
  position: relative;
  z-index: 1;
}
.side-info p {
  color: rgba(255,255,255,0.4);
  font-size: 12px;
  line-height: 1.8;
}
.side-info a {
  color: var(--accent);
  text-decoration: none;
  font-weight: 500;
  font-size: 13px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  margin-top: 16px;
  transition: gap 0.2s;
}
.side-info a:hover { gap: 10px; }
.side-info a::after { content: '→'; }

.form-panel {
  background: var(--white);
  flex: 1;
  padding: 50px 45px;
}

.form-header {
  margin-bottom: 36px;
}
.form-header h2 {
  font-family: 'Playfair Display', serif;
  font-size: 30px;
  color: var(--ink);
  line-height: 1.2;
}
.form-header p {
  color: var(--muted);
  font-size: 13px;
  margin-top: 6px;
  font-weight: 300;
}

.field-group {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  margin-bottom: 16px;
}
.field-group.full { grid-template-columns: 1fr; }

.field {
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.field label {
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: var(--muted);
}
.field input,
.field select {
  padding: 12px 14px;
  border: 1.5px solid var(--border);
  border-radius: 10px;
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  color: var(--ink);
  background: var(--paper);
  transition: border-color 0.2s, box-shadow 0.2s;
  outline: none;
  appearance: none;
  -webkit-appearance: none;
}
.field select {
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%238a8070' stroke-width='1.5' stroke-linecap='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 14px center;
  padding-right: 36px;
}
.field input:focus,
.field select:focus {
  border-color: var(--accent);
  box-shadow: 0 0 0 3px rgba(200,69,42,0.1);
  background: var(--white);
}

.submit-row {
  margin-top: 28px;
  display: flex;
  align-items: center;
  gap: 16px;
}
.btn-submit {
  flex: 1;
  padding: 14px;
  background: var(--ink);
  color: var(--white);
  border: none;
  border-radius: 10px;
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  font-weight: 500;
  letter-spacing: 0.04em;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition: transform 0.15s, box-shadow 0.15s;
}
.btn-submit::before {
  content: '';
  position: absolute;
  inset: 0;
  background: var(--accent);
  transform: translateX(-100%);
  transition: transform 0.3s cubic-bezier(.22,.9,.36,1);
}
.btn-submit:hover::before { transform: translateX(0); }
.btn-submit:hover { box-shadow: 0 8px 24px rgba(200,69,42,0.25); }
.btn-submit span { position: relative; z-index: 1; }

.toast {
  position: fixed;
  bottom: 30px; right: 30px;
  background: var(--ink);
  color: var(--white);
  padding: 14px 22px;
  border-radius: 12px;
  font-size: 13px;
  display: flex; align-items: center; gap: 10px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.2);
  transform: translateY(80px);
  opacity: 0;
  transition: all 0.4s cubic-bezier(.22,.9,.36,1);
  z-index: 999;
}
.toast.show { transform: translateY(0); opacity: 1; }
.toast-icon { width: 20px; height: 20px; background: var(--accent); border-radius: 50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:11px; }

@media(max-width: 720px) {
  .page-wrap { flex-direction: column; width: 95vw; }
  .side-panel { width: 100%; padding: 30px; }
  .form-panel { padding: 30px; }
  .field-group { grid-template-columns: 1fr; }
}
</style>
</head>
<body>

<div class="page-wrap">
  <div class="side-panel">
    <div class="side-logo">
      KFUEIT<br>University
      <span></span>
    </div>
    <div class="side-info">
      <p>Fill in your details carefully. All fields are required to complete your admission application.</p>
      <a href="records.php">View Dashboard</a>
    </div>
  </div>

  <div class="form-panel">
    <div class="form-header">
      <h2>New Admission<br>Application</h2>
      <p>Academic Year 2023–27 · Undergraduate Program</p>
    </div>

    <form action="records.php?action=insert" method="post" id="admForm">
      <div class="field-group">
        <div class="field">
          <label>Registration No.</label>
          <input type="text" name="regno" placeholder="e.g. COSC231101024" required>
        </div>
        <div class="field">
          <label>Full Name</label>
          <input type="text" name="name" placeholder="As per ID card" required>
        </div>
      </div>

      <div class="field-group full">
        <div class="field">
          <label>Email Address</label>
          <input type="email" name="email" placeholder="student@kfueit.edu.pk" required>
        </div>
      </div>

      <div class="field-group">
        <div class="field">
          <label>Department</label>
          <select name="department" required>
            <option value="">Select Department</option>
            <option>Computer Science</option>
            <option>Information Technology</option>
            <option>Business Management</option>
            <option>Biotechnology</option>
          </select>
        </div>
        <div class="field">
          <label>Semester</label>
          <select name="semester" required>
            <option value="">Select Semester</option>
            <?php for($i=1;$i<=8;$i++) echo "<option>$i</option>"; ?>
          </select>
        </div>
      </div>

      <div class="field-group full">
        <div class="field">
          <label>Admission Status</label>
          <select name="status" required>
            <option value="">Select Status</option>
            <option>Active</option>
            <option>Pending</option>
            <option>Graduated</option>
          </select>
        </div>
      </div>

      <div class="submit-row">
        <button type="submit" class="btn-submit"><span>Submit Application →</span></button>
      </div>
    </form>
  </div>
</div>

<?php if(isset($_SESSION['msg'])): ?>
<div class="toast show" id="toast">
  <div class="toast-icon">✓</div>
  <?= htmlspecialchars($_SESSION['msg']); ?>
</div>
<?php unset($_SESSION['msg']); ?>
<script>
  setTimeout(() => document.getElementById('toast').classList.remove('show'), 3500);
</script>
<?php endif; ?>

</body>
</html>