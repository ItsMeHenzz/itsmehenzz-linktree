<?php
include "config.php";

/* ambil data profil */
$userQuery = "
SELECT u.display_name, u.bio, u.profile_image
FROM users u
JOIN linktree lt ON u.user_id = lt.user_id
WHERE lt.slug = 'itsmehenzz'
LIMIT 1
";
$user = mysqli_fetch_assoc(mysqli_query($conn, $userQuery));

/* ambil link */
$linkQuery = "
SELECT link_id, title, platform
FROM links l
JOIN linktree lt ON l.linktree_id = lt.linktree_id
WHERE lt.slug = 'itsmehenzz' AND l.is_active = 1
ORDER BY l.position
";
$links = mysqli_query($conn, $linkQuery);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= $user['display_name']; ?> | Linktree</title>

<!-- Font & Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
* {
    box-sizing: border-box;
}
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #020617, #0f172a);
    color: white;
    min-height: 100vh;
}
.container {
    max-width: 420px;
    margin: auto;
    padding: 40px 20px;
}
.profile {
    text-align: center;
    margin-bottom: 30px;
}
.profile img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 0 25px rgba(56,189,248,0.5);
}
.profile h2 {
    margin: 15px 0 5px;
    font-weight: 600;
}
.profile p {
    font-size: 14px;
    color: #cbd5f5;
}
.link {
    display: flex;
    align-items: center;
    gap: 15px;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    padding: 16px 20px;
    margin: 14px 0;
    border-radius: 14px;
    text-decoration: none;
    color: white;
    font-weight: 500;
    transition: all 0.3s ease;
}
.link i {
    font-size: 22px;
}
.link:hover {
    transform: translateY(-4px) scale(1.02);
    background: #38bdf8;
    color: #020617;
}
.fa-tiktok { color: #69C9D0; }
.fa-instagram { color: #E1306C; }
.fa-heart { color: #ff4d4d; }

.footer {
    text-align: center;
    margin-top: 40px;
    font-size: 12px;
    color: #94a3b8;
}
</style>
</head>

<body>

<div class="container">

    <!-- PROFIL -->
    <div class="profile">
        <img src="assets/img/<?= $user['profile_image']; ?>" alt="Profile">
        <h2><?= $user['display_name']; ?></h2>
        <p><?= $user['bio']; ?></p>
    </div>

    <!-- LINKS -->
    <?php while ($row = mysqli_fetch_assoc($links)) : ?>
        <a class="link" href="redirect.php?id=<?= $row['link_id']; ?>">
            <?php if ($row['platform'] == 'TikTok') : ?>
                <i class="fa-brands fa-tiktok"></i>
            <?php elseif ($row['platform'] == 'Instagram') : ?>
                <i class="fa-brands fa-instagram"></i>
            <?php elseif ($row['platform'] == 'Saweria') : ?>
                <i class="fa-solid fa-heart"></i>
            <?php endif; ?>
            <?= $row['title']; ?>
        </a>
    <?php endwhile; ?>

    <div class="footer">
        © <?= date('Y'); ?> ItsMeHenzz
    </div>

</div>

</body>
</html>
