<?php
include 'connect.php';
$query = "SELECT * FROM `tbl_catagory` ORDER BY cat_id";
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
            <input type="text" id="search-input" placeholder="Search for artists...">
        </div>
    </section>

    <!-- Popular Artists Section -->
    <section>
        <h2 class="section-title">Popular Artists</h2>
        <div class="music-row">
            <div class="music-grid" id="artists-grid">
                <?php foreach ($albums as $album2) { ?>
                    <a href="song1.php?category_name=<?= urlencode($album2['cat_name']) ?>"
                        style="color:white;text-decoration:none;">
                        <div class="music-card">
                            <img src="<?= $album2['cat_pic'] ?>" alt="<?= $album2['cat_name'] ?>" class="album-art">
                            <div class="music-info">
                                <div class="music-title"><?= $album2['cat_name'] ?></div>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
        <p id="no-artists" style="color:#fff; text-align:center; display:none; margin-top:10px;">No artists found.</p>
    </section>
</main>

<script>
    const searchInput = document.getElementById('search-input');
    const artistCards = document.querySelectorAll('#artists-grid .music-card');
    const noArtistsMsg = document.getElementById('no-artists');

    searchInput.addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        let visible = false;

        artistCards.forEach(card => {
            const title = card.querySelector('.music-title').textContent.toLowerCase();
            if (title.includes(filter)) {
                card.style.display = '';
                visible = true;
            } else {
                card.style.display = 'none';
            }
        });

        noArtistsMsg.style.display = visible ? 'none' : 'block';
    });
</script>

