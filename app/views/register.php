<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <style>
    :root {
      --bg:#0f172a;
      --panel:#111827;
      --muted:#1f2937;
      --muted-2:#374151;
      --text:#e5e7eb;
      --text-dim:#9ca3af;
      --primary:#22d3ee;
      --primary-2:#06b6d4;
      --danger:#ef4444;
      --success:#22c55e;
      --radius:16px;
      --shadow:0 10px 25px rgba(0,0,0,.35);
    }
    * {
      margin:0;
      padding:0;
      box-sizing:border-box;
      font-family: 'Segoe UI', sans-serif;
    }
    body {
      background: linear-gradient(180deg,var(--bg),#0b1229 60%);
      min-height:100vh;
      display:grid;
      place-items:center;
      color:var(--text);
    }
    .card {
      width:min(420px,90vw);
      background:linear-gradient(180deg,var(--panel),#0c1328);
      border:1px solid rgba(255,255,255,.06);
      border-radius:var(--radius);
      box-shadow:var(--shadow);
      padding:32px 28px;
    }
    h2 {
      margin:0 0 20px;
      font-size:clamp(24px,3vw,32px);
      text-align:center;
      color:var(--primary);
    }
    .error {
      color:var(--danger);
      font-size:14px;
      margin-bottom:16px;
      text-align:center;
      font-weight:600;
    }
    .input-group {
      margin-bottom:18px;
      display:flex;
      flex-direction:column;
    }
    .input-group label {
      margin-bottom:6px;
      font-weight:600;
      font-size:14px;
      color:var(--text-dim);
    }
    .input-group input {
      padding:12px 14px;
      border-radius:12px;
      border:1px solid var(--muted-2);
      background:var(--muted);
      color:var(--text);
      font-size:15px;
      outline:none;
      transition:.2s;
    }
    .input-group input:focus {
      border-color:var(--primary);
      box-shadow:0 0 8px rgba(34,211,238,.4);
    }
    button {
      width:100%;
      padding:12px 16px;
      background:linear-gradient(180deg,var(--primary),var(--primary-2));
      color:#06222a;
      font-size:16px;
      font-weight:700;
      border:none;
      border-radius:12px;
      cursor:pointer;
      transition:.25s;
    }
    button:hover {
      transform:translateY(-2px);
      box-shadow:0 0 10px rgba(34,211,238,.6);
    }
    p {
      margin-top:20px;
      text-align:center;
      font-size:14px;
      color:var(--text-dim);
    }
    p a {
      color:var(--primary);
      font-weight:600;
      text-decoration:none;
    }
    p a:hover {
      text-decoration:underline;
    }
  </style>
</head>
<body>

  <div class="card">
    <form method="POST" action="/index.php/register">
      <h2>Create Account</h2>

      <?php if (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
      <?php endif; ?>

      <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter username" required>
      </div>

      <div class="input-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required>
      </div>

      <div class="input-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Re-enter password" required>
      </div>

      <button type="submit">Register</button>

      <p>Already have an account? <a href="/index.php/login">Login here</a></p>
    </form>
  </div>

</body>
</html>
