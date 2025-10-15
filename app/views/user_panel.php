<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php if (!isset($_SESSION['user_logged_in'])): ?>
  <?php header("Location: " . site_url('user_login')); exit; ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Student Dashboard</title>
  <style>
    /* ===== Global Dark Theme (same as admin) ===== */
    :root {
      --bg: #121212;
      --panel: #1f1f1f;
      --muted: #2c2c2c;
      --muted-2: #333;
      --text: #e0e0e0;
      --text-dim: #9ca3af;
      --primary: #00bcd4;
      --accent: #3f51b5;
      --radius: 8px;
    }

    html, body { height:100%; margin:0; }
    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background: var(--bg);
      color: var(--text);
      padding: 20px;
    }

    h1 {
      text-align: center;
      color: #fff;
      margin: 18px 0 12px;
      font-size: 28px;
    }

    /* Header Bar */
    .header-bar {
      display:flex;
      justify-content:space-between;
      align-items:center;
      background:var(--panel);
      padding:12px 18px;
      border-radius:var(--radius);
      margin-bottom:20px;
      box-shadow:0 4px 12px rgba(0,0,0,0.6);
    }
    .header-bar .welcome { color:var(--text-dim); }
    .header-bar a {
      background: linear-gradient(180deg,var(--accent), #5c6bc0);
      color:#fff;
      padding:8px 12px;
      border-radius:6px;
      text-decoration:none;
      font-weight:600;
    }

    /* Search */
    .search-container { width:60%; margin:18px auto; }
    .search-box {
      width:100%;
      padding:12px 14px;
      border-radius:8px;
      border:1px solid var(--muted-2);
      background:var(--panel);
      color:var(--text);
      font-size:15px;
      outline:none;
    }
    .search-box:focus { box-shadow:0 0 8px rgba(0,188,212,0.15); border-color:var(--primary); }

    /* Table Container */
    .table-wrapper {
      width: 90%;
      margin: 0 auto;
      background: var(--panel);
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.6);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
    }

    thead {
      background: var(--muted);
    }

    thead th {
      color: var(--text);
      padding: 14px 12px;
      text-align: center;
      font-weight: 700;
      font-size: 15px;
    }

    tbody td {
      padding: 14px 12px;
      text-align: center;
      color: var(--text);
      border-top: 1px solid var(--muted-2);
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    tbody tr:hover {
      background: #2a2a2a;
    }

    /* Profile image */
    td.profile img {
      border-radius:50%;
      border:2px solid var(--muted-2);
      width:50px;
      height:50px;
      object-fit:cover;
    }

    /* No records style */
    .no-record {
      text-align:center;
      color:var(--text-dim);
      background: var(--panel);
      padding: 24px;
      font-size:15px;
    }

   /* ===== Pagination (Match Admin Style) ===== */
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 6px;
  margin: 25px 0;
}

.pagination a,
.pagination span {
  padding: 8px 14px;
  background: #1f1f1f;
  border-radius: 6px;
  color: #e0e0e0;
  font-size: 14px;
  text-decoration: none;
  border: 1px solid #333;
  transition: 0.3s;
  box-shadow: 0 2px 6px rgba(0,0,0,0.4);
}

.pagination a:hover {
  background: #2c2c2c;
  color: #00bcd4;
  transform: translateY(-2px);
}

.pagination .current {
  background: #00bcd4;
  color: #fff;
  border-color: #00bcd4;
}

.pagination .disabled {
  background: #2c2c2c;
  color: #777;
  cursor: not-allowed;
  box-shadow: none;
}

    @media (max-width:800px) {
      .table-wrapper { width: 95%; }
      .search-container { width: 95%; }
      table th:nth-child(4), table th:nth-child(5),
      table td:nth-child(4), table td:nth-child(5) { display:none; }
    }
  </style>
</head>
<body>

  <div class="header-bar">
    <div class="welcome">Welcome, <?= htmlspecialchars($_SESSION['username'] ?? $_SESSION['username'] ?? 'Student') ?>!</div>
    <div><a href="<?= site_url('logout'); ?>">Logout</a></div>
  </div>

  <h1>Student Management</h1>

  <div class="search-container">
    <form method="GET" action="">
      <input class="search-box" name="search" value="<?= htmlspecialchars($search ?? '') ?>" placeholder="Search students ...">
    </form>
  </div>

  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>Profile</th>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($students)): ?>
          <?php foreach ($students as $student): ?>
            <tr>
              <td class="profile">
                <?php if (!empty($student['profile_pic'])): ?>
                  <img src="<?= site_url('upload/students/' . $student['profile_pic']) ?>" alt="Profile">
                <?php else: ?>
                  <img src="<?= site_url('public/img/default.png') ?>" alt="Default">
                <?php endif; ?>
              </td>
              <td><?= htmlspecialchars($student['id']) ?></td>
              <td title="<?= htmlspecialchars($student['first_name']) ?>"><?= htmlspecialchars($student['first_name']) ?></td>
              <td title="<?= htmlspecialchars($student['last_name']) ?>"><?= htmlspecialchars($student['last_name']) ?></td>
              <td title="<?= htmlspecialchars($student['emails']) ?>"><?= htmlspecialchars($student['emails']) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="5" class="no-record">No records found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="pagination" role="navigation" aria-label="Pagination">
    <?php if (isset($total_pages) && $total_pages > 0): ?>
      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <?php
          $class = ($i == ($page ?? 1)) ? 'current' : '';
          $link = "?page={$i}" . (isset($search) && $search !== '' ? '&search=' . urlencode($search) : '');
        ?>
        <a class="<?= $class ?>" href="<?= $link ?>"><?= $i ?></a>
      <?php endfor; ?>
    <?php endif; ?>
  </div>

</body>
</html>
