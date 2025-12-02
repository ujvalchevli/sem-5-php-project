<?php

session_start();
$loggedin = false;
$username = "Guest";
if (isset($_SESSION['username'])) {
    $loggedin = true;
    $username = $_SESSION['username'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="user.css">
</head>

<body>
    <header>
        <div class="container header-content">
            <div class="logo">
                <i class="fas fa-music"></i>
                <span>Groovo</span>
            </div>
            <nav>
                <ul>
                    <li><a href="uhome.php">Home</a></li>
                    <li><a href="allalbum.php">Album</a></li>
                    <li><a href="allcategory.php">Cetegory</a></li>
                    <li><a href="allsong.php">Song</a></li>

                </ul>
            </nav>
            <div class="user-actions">
                <?php if ($loggedin) { ?>
                    <span class="username" style="margin-top: 10px;">Welcome, <?= htmlspecialchars($username) ?></span>
                    <a href="logout.php" class="btn" style="text-decoration: none;color:white ">Logout</a>
                <?php } else { ?>
                    <a href="login.php" class="btn">Login</a>
                    <a href="register.php" class="btn">Register</a>
                <?php } ?>
            </div>
        </div>
    </header>
</body>

</html>