<?php
include 'uheader.php';
include 'connect.php';

$album_name = $_GET['album_name'];

// Fetch album info
$query = "SELECT * FROM `tbl_album` WHERE `Aname` = '$album_name'";
$result = mysqli_query($con, $query);
$album = mysqli_fetch_assoc($result);

// Fetch songs in this album
$query = "SELECT * FROM `tbl_audio` WHERE `Albumname` = '$album_name'";
$result = mysqli_query($con, $query);
$arr = [];
while ($row = mysqli_fetch_assoc($result)) {
    $arr[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($album['Aname']) ?> - HarmonyStream</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #f0f0f0;
            min-height: 100vh;
            padding-bottom: 100px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            padding: 20px 0;
            background-color: rgba(26, 26, 46, 0.8);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: 700;
            color: #4cc9f0;
            text-decoration: none;
        }

        .logo i {
            color: #4cc9f0;
        }

        .back-button {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #f0f0f0;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 16px;
            border-radius: 20px;
        }

        .back-button:hover {
            color: #4cc9f0;
            background: rgba(255, 255, 255, 0.15);
        }

        /* Album Header */
        .album-header {
            display: flex;
            gap: 30px;
            align-items: center;
            margin: 40px 0;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
        }

        .album-cover {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .album-info {
            flex: 1;
        }

        .album-title {
            font-size: 32px;
            margin-bottom: 10px;
            color: #fff;
        }

        .album-artist {
            font-size: 18px;
            color: #c2c2d6;
            margin-bottom: 20px;
        }

        .album-stats {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
            color: #a0a0c0;
        }

        .album-actions {
            display: flex;
            gap: 15px;
        }

        .action-button {
            padding: 12px 25px;
            border-radius: 30px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .play-button {
            background: #4cc9f0;
            color: #1a1a2e;
        }

        .play-button:hover {
            background: #3db0d9;
            transform: scale(1.05);
        }

        .more-button {
            background: rgba(255, 255, 255, 0.1);
            color: #f0f0f0;
        }

        .more-button:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        /* Songs List */
        .songs-list {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            overflow: hidden;
        }

        .list-header {
            display: grid;
            grid-template-columns: 50px 1fr 100px 100px;
            gap: 20px;
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: #c2c2d6;
            font-weight: 600;
        }

        .song-row {
            display: grid;
            grid-template-columns: 50px 1fr 100px 100px;
            gap: 20px;
            padding: 15px 20px;
            align-items: center;
            transition: background 0.3s;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .song-row:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .song-row.active {
            background: rgba(76, 201, 240, 0.15);
        }

        .song-number {
            text-align: center;
            color: #c2c2d6;
        }

        .song-info {
            display: flex;
            flex-direction: column;
        }

        .song-title {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .song-artist {
            font-size: 14px;
            color: #c2c2d6;
        }

        .song-duration,
        .song-plays {
            color: #c2c2d6;
        }

        .song-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }

        .song-actions i {
            cursor: pointer;
            transition: color 0.3s;
        }

        .song-actions i:hover {
            color: #4cc9f0;
        }

        /* Player Controls */
        .player-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(26, 26, 46, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.2);
        }

        .player-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .now-playing {
            display: flex;
            align-items: center;
            gap: 15px;
            width: 30%;
        }

        .now-playing-img {
            width: 50px;
            height: 50px;
            border-radius: 5px;
            object-fit: cover;
        }

        .track-info {
            white-space: nowrap;
            overflow: hidden;
        }

        .track-name {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 3px;
        }

        .artist-name {
            font-size: 12px;
            color: #c2c2d6;
        }

        .playback-controls {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 40%;
        }

        .control-buttons {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 8px;
        }

        .control-buttons i {
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .control-buttons i:hover {
            color: #4cc9f0;
        }

        .control-buttons .fa-play-circle,
        .control-buttons .fa-pause-circle {
            font-size: 36px;
        }

        .progress-bar {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .progress-time {
            font-size: 12px;
            color: #c2c2d6;
            min-width: 40px;
        }

        .progress {
            flex-grow: 1;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            cursor: pointer;
            position: relative;
        }

        .progress-fill {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background: #4cc9f0;
            border-radius: 2px;
            width: 30%;
        }

        .additional-controls {
            display: flex;
            gap: 20px;
            width: 30%;
            justify-content: flex-end;
        }

        .additional-controls i {
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .additional-controls i:hover {
            color: #4cc9f0;
        }

        /* Responsive Design */
        @media (max-width: 900px) {
            .album-header {
                flex-direction: column;
                text-align: center;
            }

            .album-cover {
                width: 200px;
                height: 200px;
            }

            .album-stats,
            .album-actions {
                justify-content: center;
            }

            .list-header,
            .song-row {
                grid-template-columns: 40px 1fr 80px;
            }

            .song-plays {
                display: none;
            }
        }

        @media (max-width: 600px) {
            .album-title {
                font-size: 24px;
            }

            .list-header,
            .song-row {
                grid-template-columns: 30px 1fr 60px;
                gap: 10px;
                padding: 10px 15px;
            }

            .player-controls {
                flex-direction: column;
                gap: 15px;
            }

            .now-playing,
            .playback-controls,
            .additional-controls {
                width: 100%;
            }

            .now-playing {
                justify-content: center;
            }

            .additional-controls {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <main class="container">
        <!-- Album Header -->
        <section class="album-header">
            <img src="<?= $album['Apic'] ?>" alt="Album Cover" class="album-cover">
            <div class="album-info">
                <h1 class="album-title"><?= $album['Aname'] ?></h1>
                <p class="album-artist">Various Artists</p>
                <div class="album-stats">
                    <div><i class="fas fa-music"></i> <?= count($arr) ?> Songs</div>
                </div>

            </div>
        </section>

        <!-- Songs List -->
        <!-- Songs List -->
        <section class="songs-list">
            <div class="list-header">
                <div class="song-number">#</div>
                <div class="song-title-header">Title</div>
                <div class="song-duration-header">Duration</div>
                <div class="song-plays-header">Singer</div>
            </div>
            <?php foreach ($arr as $index => $song): ?>
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