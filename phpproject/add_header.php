<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-music"></i>
            <h2>Music Admin</h2>
        </div>
        <nav class="sidebar-menu">
            <ul>
                <li><a href="add_home.php" class="active" data-section="dashboard"><i class="fas fa-home"></i>
                        <span>Dashboard</span></a></li>
                <li><a href="category.php" data-section="category"><i class="fas fa-list"></i> <span>Category</span></a>
                </li>
                <li><a href="audio.php" data-section="audio"><i class="fas fa-music"></i> <span>Audio</span></a></li>
                <li><a href="album.php" data-section="album"><i class="fas fa-compact-disc"></i> <span>Album</span></a>
                </li>
                <li><a href="user.php" data-section="user"><i class="fas fa-users"></i> <span>User</span></a></li>
                <li><a href="login.php" data-section="logout"><i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span></a></li>
            </ul>
        </nav>
    </aside>
    <div class="main-content">
        <header>
            <div class="header-left">
                <h1>Admin Dashboard</h1>
            </div>
            <div class="header-right">
                <div class="user-profile">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=random" alt="Admin User">
                    <span>Admin User</span>
                </div>
            </div>
        </header>
    </div>
</body>

</html>