<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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
      width: min(400px, 90vw);
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

    /* Form input + button same width */
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
      background: linear-gradient(180deg,var(--primary),var(--primary-2));
      color: #06222a;
      font-weight: 700;
      border: none;
      cursor: pointer;
    }

    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 10px rgba(34,211,238,.6);
    }

    .toggle-link, .bottom-links {
      text-align: center;
      font-size: 14px;
      margin-top: 12px;
    }

    .toggle-link {
      color: #4190ff;
      cursor: pointer;
      text-decoration: underline;
      display: inline-block;
    }

    .error {
      color: var(--danger);
      font-size: 14px;
      margin-bottom: 12px;
      font-weight: 600;
      text-align: center;
    }

    /* Transition */
    .hidden {
      opacity: 0;
      transform: translateY(20px);
      pointer-events: none;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      transition: all 0.5s ease;
    }
    .active {
      opacity: 1;
      transform: translateY(0);
      pointer-events: all;
      position: relative;
      transition: all 0.5s ease;
    }

    a {
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="card">

    <!-- 🔹 Admin Login -->
    <form id="adminForm" class="active" action="<?= site_url('/admin_login') ?>" method="POST">
      <h2>Admin Login</h2>
      <?php if (!empty($admin_error)) : ?>
        <p class="error"><?= $admin_error ?></p>
      <?php endif; ?>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login as Admin</button>

      <div class="bottom-links">
        <div class="toggle-link" onclick="toggleForm('student')">Switch to Student Login</div>
      </div>
    </form>

    <!-- 🔹 Student Login -->
    <form id="studentForm" class="hidden" action="<?= site_url('/user_login') ?>" method="POST">
      <h2>Student Login</h2>
      <?php if (!empty($user_error)) : ?>
        <p class="error"><?= $user_error ?></p>
      <?php endif; ?>
      <input type="email" name="emails" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login as Student</button>

      <div class="bottom-links">
        <p>Don't have an account? <a href="<?= site_url('register') ?>">Register here</a></p>
        <div class="toggle-link" onclick="toggleForm('admin')">Switch to Admin Login</div>
      </div>
    </form>

  </div>

  <script>
    const adminForm = document.getElementById('adminForm');
    const studentForm = document.getElementById('studentForm');

    function toggleForm(target) {
      if (target === 'student') {
        adminForm.classList.remove('active');
        adminForm.classList.add('hidden');
        setTimeout(() => {
          studentForm.classList.remove('hidden');
          studentForm.classList.add('active');
        }, 200);
      } else {
        studentForm.classList.remove('active');
        studentForm.classList.add('hidden');
        setTimeout(() => {
          adminForm.classList.remove('hidden');
          adminForm.classList.add('active');
        }, 200);
      }
    }
  </script>
</body>
</html>
