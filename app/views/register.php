<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Registration</title>
  <style>
    :root {
      --bg: #0f172a;
      --panel: #111827;
      --muted: #1f2937;
      --muted-2: #374151;
      --text: #e5e7eb;
      --text-dim: #9ca3af;
      --primary: #22d3ee;
      --primary-2: #06b6d4;
      --danger: #ef4444;
      --success: #22c55e;
      --radius: 16px;
      --shadow: 0 10px 25px rgba(0,0,0,.35);
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      min-height: 100vh;
      display: grid;
      place-items: center;
      background: linear-gradient(180deg, var(--bg), #0b1229 60%);
      color: var(--text);
      font: 18px/1.5 "Segoe UI", sans-serif;
    }

    .card {
      width: min(420px, 90vw);
      background: linear-gradient(180deg, var(--panel), #0c1328);
      border: 1px solid rgba(255,255,255,.06);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 28px 24px;
      position: relative;
    }

    h2 {
      margin: 0 0 24px;
      font-size: clamp(24px,3vw,32px);
      text-align: center;
      color: var(--primary);
    }

    input, button {
      width: 100%;
      padding: 14px;
      border-radius: 12px;
      border: 1px solid var(--muted-2);
      background: var(--muted);
      color: var(--text);
      font-size: 15px;
      outline: none;
      transition: .2s;
      display: block;
      margin-bottom: 15px;
    }

    input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 8px rgba(34,211,238,.4);
    }

    button {
      background: linear-gradient(180deg, var(--primary), var(--primary-2));
      color: #06222a;
      font-weight: 700;
      border: none;
      cursor: pointer;
    }

    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 10px rgba(34,211,238,.6);
    }

    label {
      font-size: 14px;
      color: var(--text-dim);
      margin-bottom: 6px;
      display: block;
    }

    .error {
      color: var(--danger);
      font-size: 14px;
      margin-bottom: 12px;
      font-weight: 600;
      text-align: center;
    }

    .bottom-links {
      text-align: center;
      font-size: 14px;
      margin-top: 10px;
    }

    a {
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .success {
      color: var(--success);
      font-size: 15px;
      text-align: center;
      margin-bottom: 10px;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <div class="card">
    <form action="<?= site_url('/register'); ?>" method="POST" enctype="multipart/form-data">
      <h2>Create Student Account</h2>

      <?php if (!empty($errors)): ?>
        <div class="error">
          <?php foreach ($errors as $e): ?>
            <div><?= htmlspecialchars($e) ?></div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($success_message)): ?>
        <div class="success"><?= htmlspecialchars($success_message) ?></div>
      <?php endif; ?>

      <label for="first_name">First Name</label>
      <input type="text" id="first_name" name="first_name" placeholder="Your first name" required>

      <label for="last_name">Last Name</label>
      <input type="text" id="last_name" name="last_name" placeholder="Your last name" required>

      <label for="emails">Email</label>
      <input type="email" id="emails" name="emails" placeholder="you@example.com" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>

      <label for="profile_pic">Profile Picture (optional)</label>
      <input type="file" id="profile_pic" name="profile_pic">

      <button type="submit">Register</button>

      <div class="bottom-links">
        Already have an account? <a href="<?= site_url('login') ?>">Login here</a>
      </div>
    </form>
  </div>
</body>
</html>
