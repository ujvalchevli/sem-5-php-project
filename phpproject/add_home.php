<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include 'add_header.php'; ?>

    <div class="main-content">
        <div class="content">
            <section id="dashboard-section" class="content-section">
                <div class="stats-container">
                    <?php
                    // Connect to database
                    include 'connect.php';

                    // Fetch counts
                    $user_count = $con->query("SELECT COUNT(*) as total FROM tbl_user")->fetch_assoc()['total'];
                    $audio_count = $con->query("SELECT COUNT(*) as total FROM tbl_audio")->fetch_assoc()['total'];
                    $album_count = $con->query("SELECT COUNT(*) as total FROM tbl_album")->fetch_assoc()['total'];
                    $category_count = $con->query("SELECT COUNT(*) as total FROM tbl_catagory")->fetch_assoc()['total'];
                    ?>
                    <div class="stat-card">
                        <div class="stat-icon blue"><i class="fas fa-users"></i></div>
                        <div class="stat-info">
                            <h3><?= $user_count ?></h3>
                            <p>Total Users</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon green"><i class="fas fa-music"></i></div>
                        <div class="stat-info">
                            <h3><?= $audio_count ?></h3>
                            <p>Audio Files</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon pink"><i class="fas fa-compact-disc"></i></div>
                        <div class="stat-info">
                            <h3><?= $album_count ?></h3>
                            <p>Albums</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon purple"><i class="fas fa-list"></i></div>
                        <div class="stat-info">
                            <h3><?= $category_count ?></h3>
                            <p>Categories</p>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Dashboard Overview</h2>
                    </div>
                    <div class="card-body">
                        <canvas id="dashboardChart"></canvas>
                    </div>
                </div>



            </section>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('dashboardChart').getContext('2d');
        const dashboardChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Users', 'Audio Files', 'Albums', 'Categories'],
                datasets: [{
                    label: 'Total Count',
                    data: [<?= $user_count ?>, <?= $audio_count ?>, <?= $album_count ?>, <?= $category_count ?>],
                    backgroundColor: ['#3498db', '#2ecc71', '#e84393', '#8e44ad']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Website Content Overview'
                    }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</body>

</html>

<?php include 'add_footer.php'; ?>