<?php
// 🔒 Protect page: only logged-in users can access
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
    /* ===== Global Dark Theme ===== */
    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background: #121212;
      color: #e0e0e0;
      margin: 0;
      padding: 20px;
      overflow-x: hidden;
      overflow-y: auto;
    }

    h1 {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #ffffff;
      text-align: center;
    }

    /* ===== Header Bar ===== */
    .header-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #1f1f1f;
      padding: 12px 20px;
      border-radius: 10px;
      margin-bottom: 20px;
      color: #e0e0e0;
      font-weight: 500;
      box-shadow: 0 4px 12px rgba(0,0,0,0.6);
    }
    .header-bar .welcome {
      font-size: 16px;
    }
    .header-bar a {
      color: #fff;
      text-decoration: none;
      background: #3f51b5;
      padding: 6px 12px;
      border-radius: 6px;
      transition: 0.3s;
    }
    .header-bar a:hover {
      background: #5c6bc0;
      transform: scale(1.05);
    }

    /* ===== Add Button ===== */
    .top-actions {
      text-align: center;
      margin-bottom: 20px;
    }
    .btn-add {
      background: #00bcd4;
      color: #fff;
      border: none;
      padding: 12px 24px;
      font-size: 15px;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
      box-shadow: 0 4px 10px rgba(0,0,0,0.4);
    }
    .btn-add:hover {
      background: #0097a7;
      transform: translateY(-2px);
    }

    /* ===== Search Box ===== */
    .search-container {
      margin: 20px auto;
      width: 60%;
      position: relative;
    }
    .search-box {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid #333;
      border-radius: 8px;
      font-size: 15px;
      outline: none;
      background: #1f1f1f;
      color: #e0e0e0;
      transition: 0.3s;
    }
    .search-box:focus {
      border-color: #00bcd4;
      background: #2a2a2a;
    }

    /* ===== Table ===== */
    table {
      width: 90%;
      margin: 0 auto;
      border-collapse: collapse;
      background: #1f1f1f;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.6);
    }

    thead {
      background: #2c2c2c;
      color: #ffffff;
      font-weight: bold;
    }

    th, td {
      padding: 14px 18px;
      text-align: center;
      border-bottom: 1px solid #333;
    }

    tr:hover {
      background: #2a2a2a;
    }

    /* ===== Profile Images ===== */
    td img {
      border-radius: 50%;
      border: 2px solid #333;
      width: 50px;
      height: 50px;
      object-fit: cover;
    }

    /* ===== Action Buttons ===== */
    .btn {
      display: inline-block;
      padding: 6px 14px;
      margin: 2px;
      font-size: 14px;
      border-radius: 6px;
      transition: 0.3s;
      text-decoration: none;
    }
    .btn.update {
      background: #3f51b5;
      color: #fff;
    }
    .btn.update:hover {
      background: #5c6bc0;
    }
    .btn.delete {
      background: #e53935;
      color: #fff;
    }
    .btn.delete:hover {
      background: #d32f2f;
    }

    /* ===== Pagination ===== */
    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 8px;
      margin: 25px 0;
    }
    .pagination a,
    .pagination span {
      padding: 8px 14px;
      background: #2c2c2c;
      border-radius: 6px;
      color: #e0e0e0;
      font-size: 14px;
      text-decoration: none;
      transition: 0.3s;
    }
    .pagination a:hover {
      background: #3f3f3f;
      color: #00bcd4;
    }
    .pagination .current {
      background: #00bcd4;
      color: #fff;
    }
  </style>
</head>
<body>

  <div class="header-bar">
    <div class="welcome">
      Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!
    </div>
    <div><a href="<?= site_url('logout'); ?>">Logout</a></div>
  </div>

  <h1>Student Management</h1>

  <?php if ($_SESSION['role'] === 'admin'): ?>
    <div class="top-actions">
      <a href="<?= site_url('create') ?>">
        <button class="btn-add">+ Add Student</button>
      </a>
    </div>
  <?php endif; ?>

  <div class="search-container">
    <input type="text" id="searchInput" class="search-box" placeholder="Search students...">
  </div>

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
          <img src="/upload/students/<?= $student['profile_pic'] ?>" alt="Profile">
        <?php else: ?>
          <img src="/upload/default.png" alt="No Profile">
        <?php endif; ?>
      </td> 
      <td><?= $student['id']; ?></td>
      <td><?= $student['first_name']; ?></td>
      <td><?= $student['last_name']; ?></td>
      <td><?= $student['emails']; ?></td>
      <td>
        <?php if ($_SESSION['role'] === 'admin'): ?>
          <a href="<?= site_url('/update/'.$student['id']); ?>" class="btn update">Update</a>
          <a href="<?= site_url('/delete/'.$student['id']); ?>" 
             class="btn delete"
             onclick="return confirm('Are you sure you want to delete this record?');">
             Delete
          </a>
        <?php else: ?>
          <span style="color:#9ca3af;">View Only</span>
        <?php endif; ?>
      </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

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
