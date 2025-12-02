<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query3 = "SELECT * FROM `tbl_audio` WHERE category=$id ORDER BY id DESC";
} else {
    $query3 = "SELECT * FROM `tbl_audio` ORDER BY id DESC";
}

$result3 = mysqli_query($con, $query3);
$albums3 = [];
while ($row3 = mysqli_fetch_assoc($result3)) {
    $albums3[] = $row3;
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
            <input type="text" id="search-input" placeholder="Search for songs or artists...">
        </div>
    </section>

    <!-- All Songs Section -->
    <section>
        <h2 class="section-title">
            All Songs

        </h2>
        <div class="music-row">
            <div class="music-grid" id="songs-grid">
                <?php foreach ($albums3 as $album3) { ?>
                    <div class="music-card song-row" data-title="<?= htmlspecialchars($album3['name']) ?>"
                        data-artist="<?= htmlspecialchars($album3['artist'] ?? 'Unknown Artist') ?>"
                        data-img="<?= $album3['pic'] ?>" data-src="<?= $album3['song_src'] ?>">
                        <img src="<?= $album3['pic'] ?>" alt="<?= htmlspecialchars($album3['name']) ?>" class="album-art">
                        <div class="music-info">
                            <div class="music-title"><?= $album3['name'] ?></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <p id="no-songs" style="color:#fff; text-align:center; display:none; margin-top:10px;">No songs found.</p>
    </section>
</main>

<script>
    const searchInput = document.getElementById('search-input');
    const songCards = document.querySelectorAll('#songs-grid .music-card');
    const noSongsMsg = document.getElementById('no-songs');

    searchInput.addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        let visible = false;

        songCards.forEach(card => {
            const title = card.dataset.title.toLowerCase();
            const artist = card.dataset.artist.toLowerCase();
            if (title.includes(filter) || artist.includes(filter)) {
                card.style.display = '';
                visible = true;
            } else {
                card.style.display = 'none';
            }
        });

        noSongsMsg.style.display = visible ? 'none' : 'block';
    });
</script>

<?php
include 'ufooter.php';
?>