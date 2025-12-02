<?php
include 'connect.php';
$query = "SELECT * FROM `tbl_album` ORDER BY Aid";
$result = mysqli_query($con, $query);
$albums = [];
while ($row = mysqli_fetch_assoc($result)) {
    $albums[] = $row;
}

include 'uheader.php';
?>

<style>
    .music-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        /* spacing between cards */
    }

    .music-card {
        background-color: #1c1c1c;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.2s;
    }

    .music-card:hover {
        transform: scale(1.05);
    }

    .album-art {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .music-info {
        padding: 10px;
    }

    .music-title {
        font-size: 1rem;
        font-weight: bold;
        text-align: center;
        color: #fff;
    }
</style>

<main class="container">
    <!-- Hero Section -->
    <section class="hero">
        <h1>Listen to Millions of Songs</h1>
        <p>Stream your favorite music albums, discover new tracks, and create playlists for every mood.</p>
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" id="search-input" placeholder="Search for artists, songs, or albums...">
        </div>
    </section>

    <!-- All Albums Section -->
    <section>
        <div class="section-header">
            <h2 class="section-title">All albums</h2>
            <div class="section-controls">
                <a href="allalbum.php" class="view-all">View All</a>
            </div>
        </div>

        <div class="music-grid" id="albums-grid">
            <?php foreach ($albums as $album) { ?>
                <div class="music-card">
                    <a href="song.php?album_name=<?= urlencode($album['Aname']) ?>"
                        style="color:white;text-decoration:none;">
                        <img src="<?= $album['Apic'] ?>" alt="<?= $album['Aname'] ?>" class="album-art">
                        <div class="music-info">
                            <div class="music-title"><?= $album['Aname'] ?></div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <p id="no-albums" style="color:#fff; text-align:center; display:none; margin-top:10px;">No albums found.</p>
    </section>
</main>

<script>
    const searchInput = document.getElementById('search-input');
    const albumCards = document.querySelectorAll('#albums-grid .music-card');
    const noAlbumsMsg = document.getElementById('no-albums');

    searchInput.addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        let visible = false;

        albumCards.forEach(card => {
            const title = card.querySelector('.music-title').textContent.toLowerCase();
            if (title.includes(filter)) {
                card.style.display = '';
                visible = true;
            } else {
                card.style.display = 'none';
            }
        });

        noAlbumsMsg.style.display = visible ? 'none' : 'block';
    });
</script>

