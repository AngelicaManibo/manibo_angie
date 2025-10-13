<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
    header("Location: " . site_url('login'));
    exit;
}
$user = $user ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Panel</title>
<style>
/* BODY */
body {
    font-family: 'Segoe UI', sans-serif;
    background: #1a0f0f; /* Dark burgundy */
    margin: 0;
    padding: 0;
    color: #f5f5f5;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
/* CONTAINER */
.container {
    background: #2b0f17;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.6);
    width: 100%;
    max-width: 500px;
    text-align: center;
    animation: fadeIn 0.6s ease forwards;
    opacity: 0;
}
/* PROFILE IMAGE */
.profile-card img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 3px solid #c1485d;
    object-fit: cover;
    margin-bottom: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.5);
}
/* STUDENT INFO */
.profile-info p {
    margin: 8px 0;
    font-size: 15px;
}
/* TABS */
.tabs {
    display: flex;
    justify-content: space-around;
    margin: 20px 0;
}
.tab-btn {
    background: #3c0f1f;
    color: #f5f5f5;
    padding: 10px 15px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: bold;
    border: none;
    transition: 0.3s;
}
.tab-btn.active {
    background: #c1485d;
    transform: scale(1.05);
}
/* TAB CONTENT */
.tab-content {
    display: none;
    background: #3c0f1f;
    border-radius: 12px;
    padding: 20px;
    text-align: left;
    animation: fadeIn 0.5s ease forwards;
}
.tab-content.active {
    display: block;
}
/* BUTTONS */
.edit-btn, .logout-btn {
    background: #c1485d;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin: 10px 5px 0 5px;
    font-weight: bold;
    transition: transform 0.2s, background 0.3s;
}
.edit-btn:hover, .logout-btn:hover {
    background: #e05d75;
    transform: scale(1.05);
}
.save-btn {
    background: #c1485d;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    width: 100%;
    transition: 0.3s;
}
.save-btn:hover {
    background: #e05d75;
}
</style>
</head>
<body>
<div class="container profile-card">
    <?php if (!empty($user['profile_pic'])): ?>
        <img src="/upload/students/<?= $user['profile_pic'] ?>" alt="Profile">
    <?php else: ?>
        <img src="/upload/default.png" alt="No Profile">
    <?php endif; ?>

    <div class="profile-info">
        <p><strong>ID:</strong> <?= htmlspecialchars($user['id'] ?? 'N/A'); ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($user['first_name'] . " " . $user['last_name'] ?? 'N/A'); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['emails'] ?? 'N/A'); ?></p>
    </div>

    <!-- TABS -->
    <div class="tabs">
        <button class="tab-btn" onclick="showTab('activity')">Activity</button>
    </div>

    <!-- TAB CONTENT -->
    <div id="activity" class="tab-content">
        <p>Recent Activity:</p>
        
        <ul>
            <li>Logged in today</li>
            <li>Updated profile</li>
        </ul>
    </div>

    <a href="<?= site_url('user_update/' . ($user['id'] ?? 0)); ?>"><button class="edit-btn">Edit Profile</button></a>
    <a href="<?= site_url('logout'); ?>"><button class="logout-btn">Logout</button></a>
</div>

<script>
function showTab(tabId) {
    const tabs = document.querySelectorAll('.tab-content');
    const btns = document.querySelectorAll('.tab-btn');
    tabs.forEach(t => t.classList.remove('active'));
    btns.forEach(b => b.classList.remove('active'));
    document.getElementById(tabId).classList.add('active');
    event.currentTarget.classList.add('active');
}
</script>

</body>
</html>




