<?php
include 'connect.php';

// Fetch Recently Played Albums
$query = "SELECT * FROM `tbl_album` ORDER BY Aid LIMIT 8";
$result = mysqli_query($con, $query);
$albums = [];
while ($row = mysqli_fetch_assoc($result)) {
    $albums[] = $row;
}

// Fetch Popular Artists / Categories
$query2 = "SELECT * FROM `tbl_catagory` ORDER BY cat_id LIMIT 6";
$result2 = mysqli_query($con, $query2);
$albums2 = [];
while ($row2 = mysqli_fetch_assoc($result2)) {
    $albums2[] = $row2;
}

// Fetch New Releases / Songs
$query3 = "SELECT * FROM `tbl_audio` ORDER BY id LIMIT 8";
$result3 = mysqli_query($con, $query3);
$albums3 = [];
while ($row3 = mysqli_fetch_assoc($result3)) {
    $albums3[] = $row3;
}

include 'uheader.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HarmonyStream</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="user.css">
</head>

<body>
    <main class="container">

        <!-- Hero Section -->
        <section class="hero">
            <h1>Listen to Millions of Songs</h1>
            <p>Stream your favorite music albums, discover new tracks, and create playlists for every mood.</p>
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" id="search-input" placeholder="Search for albums, artists, or songs...">
            </div>
        </section>

        <!-- Recently Played -->
        <section>
            <div class="section-header">
                <h2 class="section-title">Popular Album</h2>
                <div class="section-controls">
                    <a href="allalbum.php" class="view-all">View All</a>
                </div>
            </div>
            <div class="music-row">
                <button class="scroll-btn scroll-left"><i class="fas fa-chevron-left"></i></button>
                <div class="music-grid" id="albums-grid">
                    <?php foreach ($albums as $album) { ?>
                        <div class="music-card">
                            <a style="color: white; text-decoration: none;"
                                href="song.php?album_name=<?= urlencode($album['Aname']) ?>">
                                <img src="<?= $album['Apic'] ?>" alt="Album Cover" class="album-art">
                                <div class="music-info">
                                    <div class="music-title"><?= $album['Aname'] ?></div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <button class="scroll-btn scroll-right"><i class="fas fa-chevron-right"></i></button>
            </div>
            <p id="no-albums" style="display:none; color:#fff;">No albums found.</p>
        </section>

        <!-- Popular Artists -->
        <section>
            <div class="section-header">
                <h2 class="section-title">Popular Artists</h2>
                <a href="allcategory.php" class="view-all">View All</a>
            </div>
            <div class="music-row">
                <button class="scroll-btn scroll-left"><i class="fas fa-chevron-left"></i></button>
                <div class="music-grid" id="artists-grid">
                    <?php foreach ($albums2 as $album2) { ?>
                        <a style="color: white; text-decoration: none;"
                            href="song1.php?category_name=<?= urlencode($album2['cat_name']) ?>">
                            <div class="music-card">
                                <img src="<?= $album2['cat_pic'] ?>" alt="Playlist Cover" class="album-art" >
                                <div class="music-info">
                                    <div class="music-title"><?= $album2['cat_name'] ?></div>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
                <button class="scroll-btn scroll-right"><i class="fas fa-chevron-right"></i></button>
            </div>
            <p id="no-artists" style="display:none; color:#fff;">No artists found.</p>
        </section>

        <!-- New Releases -->
        <section>
            <div class="section-header">
                <h2 class="section-title">New Releases</h2>
                <a href="allsong.php" class="view-all">View All</a>
            </div>
            <div class="music-row">
                <button class="scroll-btn scroll-left"><i class="fas fa-chevron-left"></i></button>
                <div class="music-grid" id="songs-grid">
                    <?php foreach ($albums3 as $album3) { ?>
                        <div class="music-card song-row" data-title="<?= htmlspecialchars($album3['name']) ?>"
                            data-artist="<?= htmlspecialchars($album3['artist'] ?? 'Unknown Artist') ?>"
                            data-img="<?= $album3['pic'] ?>" data-src="<?= $album3['song_src'] ?>">
                            <img src="<?= $album3['pic'] ?>" alt="Album Cover" class="album-art">
                            <div class="music-info">
                                <div class="music-title"><?= $album3['name'] ?></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <button class="scroll-btn scroll-right"><i class="fas fa-chevron-right"></i></button>
            </div>
            <p id="no-songs" style="display:none; color:#fff;">No songs found.</p>
        </section>

    </main>

    <!-- Scripts -->
    <script>
        // Horizontal scrolling buttons
        document.querySelectorAll('.music-row').forEach(row => {
            const grid = row.querySelector('.music-grid');
            const leftBtn = row.querySelector('.scroll-left');
            const rightBtn = row.querySelector('.scroll-right');

            leftBtn.addEventListener('click', () => {
                grid.scrollBy({ left: -220, behavior: 'smooth' });
            });

            rightBtn.addEventListener('click', () => {
                grid.scrollBy({ left: 220, behavior: 'smooth' });
            });
        });

        // Active search
        const searchInput = document.getElementById('search-input');

        searchInput.addEventListener('input', function () {
            const filter = this.value.toLowerCase();

            // Albums
            let albumVisible = false;
            document.querySelectorAll('#albums-grid .music-card').forEach(card => {
                const text = card.querySelector('.music-title').textContent.toLowerCase();
                if (text.includes(filter)) {
                    card.style.display = '';
                    albumVisible = true;
                } else {
                    card.style.display = 'none';
                }
            });
            document.getElementById('no-albums').style.display = albumVisible ? 'none' : 'block';

            // Artists
            let artistVisible = false;
            document.querySelectorAll('#artists-grid .music-card').forEach(card => {
                const text = card.querySelector('.music-title').textContent.toLowerCase();
                if (text.includes(filter)) {
                    card.style.display = '';
                    artistVisible = true;
                } else {
                    card.style.display = 'none';
                }
            });
            document.getElementById('no-artists').style.display = artistVisible ? 'none' : 'block';

            // Songs
            let songVisible = false;
            document.querySelectorAll('#songs-grid .music-card').forEach(card => {
                const title = card.dataset.title.toLowerCase();
                const artist = card.dataset.artist.toLowerCase();
                if (title.includes(filter) || artist.includes(filter)) {
                    card.style.display = '';
                    songVisible = true;
                } else {
                    card.style.display = 'none';
                }
            });
            document.getElementById('no-songs').style.display = songVisible ? 'none' : 'block';
        });
    </script>
</body>

</html>