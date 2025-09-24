<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Student</title>
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
    --radius:16px; 
    --shadow:0 10px 25px rgba(0,0,0,.35);
  }
  * { box-sizing:border-box; }
  body {
    margin:0;
    min-height:100vh;
    display:grid;
    place-items:center;
    background:linear-gradient(180deg,var(--bg),#0b1229 60%);
    color:var(--text);
    font:16px/1.5 "Segoe UI", sans-serif;
  }
  .card {
    width:min(480px,90vw);
    background:linear-gradient(180deg,var(--panel),#0c1328);
    border:1px solid rgba(255,255,255,.06);
    border-radius:var(--radius);
    box-shadow:var(--shadow);
    padding:32px 28px;
  }
  h2 {
    margin:0 0 24px;
    font-size:clamp(22px,3vw,28px);
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
  .input-group input[type="file"] {
    padding:8px;
    cursor:pointer;
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
  .profile-preview {
    text-align:center; 
    margin-bottom:15px;
  }
  .profile-preview img {
    border-radius:50%; 
    border:2px solid var(--primary);
  }
  .profile-preview p {
    color:var(--text-dim); 
    font-size:14px; 
    margin-top:6px;
  }
  .actions {
    margin-top:20px;
    text-align:center;
  }
  .back-link {
    display:inline-block;
    background:var(--muted);
    color:var(--primary);
    font-weight:600;
    text-decoration:none;
    padding:10px 18px;
    border-radius:12px;
    transition:all 0.3s ease-in-out;
  }
  .back-link:hover {
    background:var(--muted-2);
    text-decoration:underline;
  }
</style>
</head>
<body>
  <div class="card">
    <h2>Update Student</h2>

    <?php if (!empty($errors)): ?>
      <div class="error">
        <ul>
          <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form action="<?=site_url('/update/'.segment(3));?>" method="POST" enctype="multipart/form-data">
      <div class="input-group">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" value="<?=$student['first_name'];?>" placeholder="Your first name">
      </div>

      <div class="input-group">
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" value="<?=$student['last_name'];?>" placeholder="Your last name">
      </div>

      <div class="input-group">
        <label for="emails">Email</label>
        <input type="email" id="emails" name="emails" value="<?=$student['emails'];?>" placeholder="you@example.com">
      </div>

      <?php if (!empty($student['profile_pic'])): ?>
        <div class="profile-preview">
          <img src="/upload/students/<?=$student['profile_pic'];?>" alt="Current Profile" width="90" height="90">
          <p>Current Profile Picture</p>
        </div>
      <?php endif; ?>

      <div class="input-group">
        <label for="profile_pic">Change Profile Picture</label>
        <input type="file" id="profile_pic" name="profile_pic" accept="image/*">
      </div>

      <button type="submit">Update</button>
    </form>

    <div class="actions">
      <a class="back-link" href="<?=site_url('get_all')?>">⬅ Back to Students</a>
    </div>
  </div>
</body>
</html>
