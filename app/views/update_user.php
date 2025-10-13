<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure user data is passed
$student = $student ?? [];
$errors  = $errors ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>🐾 Update Profile</title>
<style>
body {
    font-family: 'Comic Sans MS', cursive, sans-serif;
    background-color: #fff8f0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: hidden;
}
form {
    background-color: #fff0f5;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    width: 350px;
    position: relative;
    z-index: 10;
    animation: popIn 0.8s ease;
}
h2 {
    text-align: center;
    color: #ff69b4;
    margin-bottom: 20px;
    animation: bounce 1.5s infinite;
}
label {
    display: block;
    margin-bottom: 5px;
    color: #ff69b4;
    font-weight: bold;
}
input[type="text"],
input[type="email"],
input[type="file"],
input[type="password"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 2px solid #ffb6c1;
    border-radius: 10px;
    outline: none;
    transition: 0.3s;
}
input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
    border-color: #ff69b4;
    background-color: #ffe4e1;
    box-shadow: 0 0 8px #ffb6c1;
}
input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #ff69b4;
    border: none;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}
input[type="submit"]:hover {
    background-color: #ff1493;
    transform: scale(1.05);
}
.actions {
    margin-top: 20px;
    text-align: center;
}

.back-link {
 display: inline-block;
    background-color: #ffe4e1;
    color: #ff69b4;
    font-weight: bold;
    text-decoration: none;
    padding: 10px 18px;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    transition: all 0.3s ease-in-out;
    font-family: 'Comic Sans MS', cursive, sans-serif;
}
.error-list {
    color: red;
    margin-bottom: 20px;
}
</style>
</head>
<body>
<?php if (!empty($errors)): ?>
<div class="error-list">
    <ul>
    <?php foreach ($errors as $e): ?>
        <li><?= htmlspecialchars($e) ?></li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

    <form action="<?= site_url('/user_update/' . $student['id']); ?>" method="POST" enctype="multipart/form-data">
    <h2>Update My Profile</h2>

    <label for="first_name">First Name</label>
    <input type="text" name="first_name" id="first_name" value="<?= htmlspecialchars($student['first_name']); ?>" placeholder="First Name">
    
    <label for="last_name">Last Name</label>
    <input type="text" name="last_name" id="last_name" value="<?= htmlspecialchars($student['last_name']); ?>" placeholder="Last Name">

    <label for="emails">Email</label>
    <input type="email" name="emails" id="emails" value="<?= htmlspecialchars($student['emails']); ?>" placeholder="Email">

    <!-- 🐾 New Password Field -->
    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Enter new password (leave blank to keep current)">

    <?php if (!empty($student['profile_pic'])): ?>
        <div style="text-align:center; margin-bottom:15px;">
            <img src="/upload/students/<?= $student['profile_pic']; ?>" alt="Profile" width="80" height="80" style="border-radius:50%; border:2px solid #ffb6c1;">
            <p style="color:#ff69b4; font-size:14px; margin-top:5px;">Current Profile Picture</p>
        </div>

<?php endif; ?>

    <label for="profile_pic">Change Profile Picture</label>
    <input type="file" name="profile_pic" id="profile_pic" accept="image/*">

    <input type="submit" value="Update ✨">

    <div class="actions">
        <a class="back-link" href="<?= site_url('user_panel'); ?>">⬅️ 🐱 Back to My Profile</a>
    </div>
</form>

</body>
</html>









