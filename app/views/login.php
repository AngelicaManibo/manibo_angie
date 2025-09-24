<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    :root{
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
    *{box-sizing:border-box;}
    body {
      margin:0;
      min-height:100vh;
      display:grid;
      place-items:center;
      background:linear-gradient(180deg,var(--bg),#0b1229 60%);
      color:var(--text);
      font:18px/1.5 "Segoe UI", sans-serif;
    }
    .card {
      width:min(400px,90vw);
      background:linear-gradient(180deg,var(--panel),#0c1328);
      border:1px solid rgba(255,255,255,.06);
      border-radius:var(--radius);
      box-shadow:var(--shadow);
      padding:28px 24px;
    }
    h2 {
      margin:0 0 24px;
      font-size:clamp(24px,3vw,32px);
      text-align:center;
      color:var(--primary);
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
    .error {
      color:var(--danger);
      font-size:14px;
      margin-bottom:12px;
      font-weight:600;
      text-align:center;
    }
    p {
      margin-top:20px;
      text-align:center;
      font-size:14px;
      color:var(--text-dim);
    }
    a {
      color:var(--primary);
      font-weight:600;
      text-decoration:none;
    }
    a:hover {
      text-decoration:underline;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>Login</h2>

    <?php if (!empty($error)) : ?>
      <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form action="<?= site_url('login') ?>" method="POST">
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Enter your username" required>
      </div>

      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>
      </div>

      <button type="submit">Login</button>
    </form>

    <p>Don’t have an account? <a href="<?= site_url('register') ?>">Register here</a></p>
  </div>
</body>
</html>
