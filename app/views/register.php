<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: " . site_url('login'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Management</title>
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
      --radius:14px; 
      --shadow:0 10px 25px rgba(0,0,0,.35);
    }
    *{box-sizing:border-box;}
    body {
      margin:0;
      min-height:100vh;
      background:linear-gradient(180deg,var(--bg),#0b1229 60%);
      color:var(--text);
      font:16px/1.5 "Segoe UI", sans-serif;
      padding:30px;
    }

    h1 {
      margin:0 0 24px;
      font-size:clamp(22px,3vw,28px);
      text-align:center;
      color:var(--primary);
    }

    .header-bar {
      display:flex;
      justify-content:space-between;
      align-items:center;
      background:var(--panel);
      padding:12px 18px;
      border-radius:var(--radius);
      margin-bottom:20px;
      box-shadow:var(--shadow);
    }
    .header-bar .welcome {
      color:var(--text-dim);
      font-size:15px;
    }
    .header-bar a {
      background:linear-gradient(180deg,var(--danger),#b91c1c);
      padding:8px 14px;
      border-radius:10px;
      color:#fff;
      text-decoration:none;
      font-weight:600;
      transition:.25s;
    }
    .header-bar a:hover {
      box-shadow:0 0 10px rgba(239,68,68,.6);
      transform:translateY(-2px);
    }

    .btn-add {
      display:inline-block;
      margin:20px 0;
      background:linear-gradient(180deg,var(--primary),var(--primary-2));
      color:#06222a;
      font-weight:700;
      padding:12px 18px;
      border:none;
      border-radius:var(--radius);
      text-decoration:none;
      transition:.25s;
      box-shadow:var(--shadow);
    }
    .btn-add:hover {
      transform:translateY(-2px);
      box-shadow:0 0 10px rgba(34,211,238,.6);
    }

    .search-container {
      width:min(400px,100%);
      margin:0 auto 25px;
    }
    .search-box {
      width:100%;
      padding:12px 14px;
      border-radius:var(--radius);
      border:1px solid var(--muted-2);
      background:var(--muted);
      color:var(--text);
      outline:none;
      transition:.25s;
    }
    .search-box:focus {
      border-color:var(--primary);
      box-shadow:0 0 8px rgba(34,211,238,.4);
    }

    .table-wrapper {
      overflow-x:auto;
      background:var(--panel);
      border-radius:var(--radius);
      box-shadow:var(--shadow);
      padding:10px;
    }
    table {
      width:100%;
      border-collapse:collapse;
      color:var(--text);
    }
    thead {
      background:var(--muted);
    }
    thead th {
      padding:12px;
      text-align:left;
      font-size:14px;
      color:var(--text-dim);
    }
    tbody td {
      padding:12px;
      border-top:1px solid var(--muted-2);
      font-size:15px;
    }
    tr:hover td {
      background:var(--muted);
    }
    td img {
      border-radius:50%;
    }

    .btn {
      padding:6px 12px;
      border-radius:8px;
      font-size:14px;
      font-weight:600;
      text-decoration:none;
      margin:2px;
      display:inline-block;
      transition:.25s;
    }
    .btn.update {
      background:linear-gradient(180deg,#3b82f6,#2563eb);
      color:#fff;
    }
    .btn.update:hover {
      box-shadow:0 0 8px rgba(59,130,246,.6);
      transform:translateY(-2px);
    }
    .btn.delete {
      background:linear-gradient(180deg,var(--danger),#b91c1c);
      color:#fff;
    }
    .btn.delete:hover {
      box-shadow:0 0 8px rgba(239,68,68,.6);
      transform:translateY(-2px);
    }

    .pagination {
      display:flex;
      justify-content:center;
      gap:8px;
      margin:20px 0;
    }
    .pagination a,
    .pagination span {
      padding:8px 12px;
      border-radius:8px;
      background:var(--muted);
      color:var(--text);
      font-size:14px;
      text-decoration:none;
      transition:.25s;
    }
    .pagination a:hover {
      background:var(--muted-2);
      color:var(--primary);
    }
    .pagination .current {
      background:var(--primary);
      color:#06222a;
      font-weight:700;
    }
  </style>
</head>
<body>

  <div class="header-bar">
    <div class="welcome">Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</div>
    <div><a href="<?= site_url('logout'); ?>">Logout</a></div>
  </div>

  <h1>Student Management</h1>

  <div style="text-align:center;">
    <a href="<?=site_url('create')?>" class="btn-add">+ Add Student</a>
  </div>

  <div class="search-container">
    <input type="text" id="searchInput" class="search-box" placeholder="Search students...">
  </div>

  <div class="table-wrapper">
    <table id="studentTable">
      <thead>
        <tr>
          <th>Profile</th>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($students as $student): ?>
        <tr>
          <td>
            <?php if (!empty($student['profile_pic'])): ?>
              <img src="/upload/students/<?= $student['profile_pic'] ?>" alt="Profile" width="45" height="45">
            <?php else: ?>
              <img src="/upload/default.png" alt="No Profile" width="45" height="45">
            <?php endif; ?>
          </td>
          <td><?= $student['id']; ?></td>
          <td><?= $student['first_name']; ?></td>
          <td><?= $student['last_name']; ?></td>
          <td><?= $student['emails']; ?></td>
          <td>
            <a href="<?= site_url('/update/'.$student['id']); ?>" class="btn update">Update</a>
            <a href="<?= site_url('/delete/'.$student['id']); ?>" 
               class="btn delete"
               onclick="return confirm('Are you sure you want to delete this record?');">
               Delete
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="pagination">
    <?= isset($pagination_links) ? $pagination_links : '' ?>
  </div>

<script>
let typingTimer;
document.getElementById("searchInput").addEventListener("keyup", function() {
  clearTimeout(typingTimer);
  let keyword = this.value;

  typingTimer = setTimeout(() => {
    fetch("<?= site_url('students/search') ?>?keyword=" + keyword)
      .then(res => res.text())
      .then(data => {
        document.querySelector("#studentTable tbody").innerHTML = data;
      });
  }, 300);
});
</script>

</body>
</html>
