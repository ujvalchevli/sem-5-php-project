<style>
    .volume-control {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .volume-slider {
        width: 80px;
    }
</style>
<div class="player-container">
    <div class="player-controls">
        <div class="now-playing">
            <img src="https://source.unsplash.com/random/100x100/?album,cover,16" alt="Now Playing"
                class="now-playing-img">
            <div class="track-info">
                <div class="track-name">Select a song</div>
                <div class="artist-name">Artist</div>
            </div>
        </div>

        <div class="playback-controls">
            <div class="control-buttons">

                <i class="fas fa-step-backward prev-btn"></i>
                <i class="fas fa-play-circle play-btn"></i>
                <i class="fas fa-step-forward next-btn"></i>

            </div>
            <div class="progress-bar">
                <div class="progress-time current-time">0:00</div>
                <div class="progress">
                    <div class="progress-fill"></div>
                </div>
                <div class="progress-time total-time">0:00</div>
            </div>
        </div>

        <div class="additional-controls">

            <div class="volume-control">
                <i class="fas fa-volume-up volume-btn"></i>
                <input type="range" class="volume-slider" min="0" max="1" step="0.01" value="1">
            </div>

        </div>
    </div>
    <!-- Hidden Audio Player -->
    <audio id="audio-player"></audio>
</div>

<script>
    const audioPlayer = document.getElementById('audio-player');
    const playButton = document.querySelector('.play-btn');
    const nextButton = document.querySelector('.next-btn');
    const prevButton = document.querySelector('.prev-btn');
    const progress = document.querySelector('.progress');
    const progressFill = document.querySelector('.progress-fill');
    const currentTimeEl = document.querySelector('.current-time');
    const totalTimeEl = document.querySelector('.total-time');
    const volumeBtn = document.querySelector('.volume-btn');
    const volumeSlider = document.querySelector('.volume-slider');

    let isPlaying = false;
    let currentIndex = -1;
    let songRows = [];

    // Format seconds to mm:ss
    function formatTime(seconds) {
        if (isNaN(seconds)) return "0:00";
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs < 10 ? '0' + secs : secs}`;
    }

    // Load and play a song by index
    function playSong(index) {
        if (index < 0 || index >= songRows.length) return;
        currentIndex = index;
        const row = songRows[currentIndex];

        const title = row.dataset.title;
        const artist = row.dataset.artist;
        const imgSrc = row.dataset.img;
        const src = row.dataset.src;

        document.querySelector('.track-name').textContent = title;
        document.querySelector('.artist-name').textContent = artist;
        document.querySelector('.now-playing-img').src = imgSrc;

        audioPlayer.src = src;
        audioPlayer.play();
    }

    // Play/Pause button
    playButton.addEventListener('click', function () {
        if (isPlaying) {
            audioPlayer.pause();
        } else {
            audioPlayer.play();
        }
    });

    audioPlayer.addEventListener('play', () => {
        isPlaying = true;
        playButton.classList.remove('fa-play-circle');
        playButton.classList.add('fa-pause-circle');
    });

    audioPlayer.addEventListener('pause', () => {
        isPlaying = false;
        playButton.classList.remove('fa-pause-circle');
        playButton.classList.add('fa-play-circle');
    });

    // Progress bar
    audioPlayer.addEventListener('loadedmetadata', () => {
        totalTimeEl.textContent = formatTime(audioPlayer.duration);
    });

    audioPlayer.addEventListener('timeupdate', () => {
        const progressPercent = (audioPlayer.currentTime / audioPlayer.duration) * 100;
        progressFill.style.width = progressPercent + '%';
        currentTimeEl.textContent = formatTime(audioPlayer.currentTime);
    });

    progress.addEventListener('click', function (e) {
        const width = this.clientWidth;
        const clickX = e.offsetX;
        const newTime = (clickX / width) * audioPlayer.duration;
        audioPlayer.currentTime = newTime;
    });

    // Next / Previous buttons
    nextButton.addEventListener('click', () => {
        if (currentIndex < songRows.length - 1) {
            playSong(currentIndex + 1);
        } else {
            playSong(0); // loop back
        }
    });

    prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            playSong(currentIndex - 1);
        } else {
            playSong(songRows.length - 1); // go to last
        }
    });

    // Auto play next when song ends
    audioPlayer.addEventListener('ended', () => {
        nextButton.click();
    });

    // Volume control
    volumeBtn.addEventListener('click', () => {
        audioPlayer.muted = !audioPlayer.muted;
        volumeBtn.classList.toggle('fa-volume-mute', audioPlayer.muted);
        volumeBtn.classList.toggle('fa-volume-up', !audioPlayer.muted);
    });

    volumeSlider.addEventListener('input', () => {
        audioPlayer.volume = volumeSlider.value;
        audioPlayer.muted = audioPlayer.volume === 0;
        volumeBtn.classList.toggle('fa-volume-mute', audioPlayer.muted);
        volumeBtn.classList.toggle('fa-volume-up', !audioPlayer.muted);
    });

    // Get songs from song.php
    songRows = Array.from(document.querySelectorAll('.song-row'));
    songRows.forEach((row, index) => {
        row.addEventListener('click', () => {
            playSong(index);
        });
    });



</script>
</body>

</html>