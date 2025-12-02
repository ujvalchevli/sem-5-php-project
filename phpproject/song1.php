<?php
include 'uheader.php';
include 'connect.php';

$category_name = $_GET['category_name'] ?? '';

// Escape input to prevent SQL injection
$category_name = mysqli_real_escape_string($con, $category_name);

// Fetch category info
$query = "SELECT * FROM `tbl_catagory` WHERE `cat_name` = '$category_name'";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($con));
}
$category = mysqli_fetch_assoc($result);

// Fetch songs by this category
$query2 = "SELECT * FROM `tbl_audio` WHERE `category` = '$category_name'";
$result2 = mysqli_query($con, $query2);

if (!$result2) {
    die("Query Failed: " . mysqli_error($con));
}

$songs = [];
while ($row = mysqli_fetch_assoc($result2)) {
    $songs[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($category['cat_name']) ?> - HarmonyStream</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reuse same styling as song.php */
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #f0f0f0;
            min-height: 100vh;
            padding-bottom: 100px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .category-header {
            display: flex;
            gap: 30px;
            align-items: center;
            margin: 40px 0;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
        }

        .category-cover {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .category-info h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .songs-list {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            overflow: hidden;
        }

        .list-header,
        .song-row {
            display: grid;
            grid-template-columns: 50px 1fr 100px 100px;
            gap: 20px;
            padding: 15px 20px;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .song-row:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .song-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .song-info img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
        }
    </style>
</head>

<body>
    <main class="container">
        <!-- Category Header -->
        <section class="category-header">
            <img src="<?= $category['cat_pic'] ?>" alt="Category Cover" class="category-cover">
            <div class="category-info">
                <h1><?= htmlspecialchars($category['cat_name']) ?></h1>
                <p><?= count($songs) ?> Songs</p>
            </div>
        </section>

        <!-- Songs List -->
        <section class="songs-list">
            <div class="list-header">
                <div>#</div>
                <div>Title</div>
                <div>Duration</div>
                <div>Singer</div>
            </div>
            <?php foreach ($songs as $index => $song): ?>
                <div class="song-row" data-src="<?= $song['song_src'] ?>"
                    data-title="<?= htmlspecialchars($song['name']) ?>"
                    data-artist="<?= htmlspecialchars($song['singername']) ?>" data-img="<?= $song['pic'] ?>">
                    <div class="song-number"><?= $index + 1 ?></div>
                    <div class="song-info">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <img src="<?= $song['pic'] ?>" alt="<?= $song['name'] ?>"
                                style="width:50px;height:50px;object-fit:cover;border-radius:6px;">
                            <div>
                                <div class="song-title"><?= $song['name'] ?></div>
                                <div class="song-artist"><?= $song['singername'] ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="song-duration"><?= $song['uration'] ?></div>
                    <div class="song-plays"><?= $song['singername'] ?></div>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
</body>

</html>
<?php include 'ufooter.php'; ?>