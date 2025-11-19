const playButton = document.getElementById('playBt');
const volumeControl = document.getElementById('volume');
const audio = document.getElementById('audio');
const progressCircle = document.getElementById('progressCircle');
const progressText = document.getElementById('progressText');
const progressSlider = document.getElementById('progressSlider');
const timeDisplay = document.getElementById('timeDisplay');

class MusicPlayer {
    constructor(tracks) {
        this.vinyl_angle = 0;
        this.change_amount = 11;
        this.tracks = tracks;
        this.currentTrackIndex = 0;
        this.currentTrackID = 0;
        this.isPlaying = false;
        this.isMoving = false;
        this.last_angle = 0;

        // Web Audio API setup
        this.audioContext = null;
        this.sourceNode = null;
        this.gainNode = null;
        this.audioBuffer = null;
        this.startTime = 0;
        this.pauseTime = 0;
        this.duration = 0;
        this.isLoading = false;

        // DOM elements
        this.seekbar = document.getElementById('progressCircle');
        this.vinyl = document.getElementsByClassName('track-art')[0];
        this.songLength = document.getElementsByClassName('song-length')[0];
        this.timeDisplay = document.getElementById('timeDisplay');
        this.title = document.getElementById('track-title');
        this.artist = document.getElementById('track-artist');
        this.coverArt = document.getElementById('pic');
        this.songButton = null;

        // Initialize Web Audio API
        this.initAudioContext();

        // Update timer
        this.updateInterval = setInterval(() => this.updateTime(), 100);

        // Handle seekbar click/drag
        this.boundChangeSeek = this.changeSeek.bind(this);
        this.boundMouseup = this.mouseup.bind(this);
        this.seekbar.addEventListener('mousedown', (e) => this.click(e));
    }

    async initAudioContext() {
        this.audioContext = new (window.AudioContext || window.webkitAudioContext)();
        this.gainNode = this.audioContext.createGain();
        this.gainNode.connect(this.audioContext.destination);
    }

    async loadTrack(index) {
        // Update UI
        if(this.isLoading)
        {
            return;
        }
        this.isLoading = true;
        if(this.currentTrackIndex == index) {
            return 0;
        }
        if (!this.tracks[index].cover) {
            this.coverArt.style.objectFit = 'cover';
            this.coverArt.src = "https://placehold.co/300x200?text=" + this.tracks[index].artist;
        } else {
            this.coverArt.style.objectFit = 'scale-down';
            this.coverArt.src = "storage/" + this.tracks[index].cover;
        }

        if (this.songButton != null) {
            this.songButton.classList.remove('fa-pause');
            this.songButton.classList.add('fa-play');
        }

        this.currentTrackID = this.tracks[index].id;
        this.currentTrackIndex = index;
        this.songButton = document.getElementById('playBt' + this.tracks[index].id);

        this.title.textContent = "Title: " + this.tracks[index].title;
        this.artist.textContent = "Track Artist: " + this.tracks[index].artist;

        // Load audio using Web Audio API
        try {
            const url = "storage/" + this.tracks[index].url;
            const response = await fetch(url);
            const arrayBuffer = await response.arrayBuffer();

            // Stop current audio if playing
            if (this.isPlaying) {
                this.stopAudio();
            }

            this.audioBuffer = await this.audioContext.decodeAudioData(arrayBuffer);
            this.duration = this.audioBuffer.duration;
            this.pauseTime = 0;

            // Update duration display
            this.songLength.textContent = Math.floor(this.duration / 60) + ":" +
                (Math.floor(this.duration % 60) < 10 ? "0" + Math.floor(this.duration % 60) : Math.floor(this.duration % 60));

            console.log("Track loaded:", this.tracks[index].title, "Duration:", this.duration);
        } catch (error) {
            console.error("Error loading track:", error);
        }
        this.isLoading = false;
    }

    playAudio() {
        if (!this.audioBuffer) {
            console.error("No audio loaded");
            return;
        }

        if (this.sourceNode) {
            try {
                this.sourceNode.stop();
                this.sourceNode.disconnect();
            } catch (e) {
                console.warn("Error stopping previous source:", e);
            }
        }

        // Create new source node
        this.sourceNode = this.audioContext.createBufferSource();
        this.sourceNode.buffer = this.audioBuffer;
        this.sourceNode.connect(this.gainNode);

        // Start playing from pauseTime
        this.sourceNode.start(0, this.pauseTime);
        this.startTime = this.audioContext.currentTime - this.pauseTime;
        this.isPlaying = true;

        // Handle end of audio
        this.sourceNode.onended = () => {
            if (this.isPlaying) {
                this.isPlaying = false;
                this.pauseTime = 0;
            }
        };
    }

    pauseAudio() {
        if (!this.isPlaying) return;

        // Calculate current position
        this.pauseTime = this.audioContext.currentTime - this.startTime;

        // Stop the source
        if (this.sourceNode) {
            this.sourceNode.stop();
            this.sourceNode.disconnect();
        }

        this.isPlaying = false;
    }

    stopAudio() {
        if (this.sourceNode) {
            this.sourceNode.stop();
            this.sourceNode.disconnect();
        }
        this.isPlaying = false;
        this.pauseTime = 0;
    }

    seekTo(time) {
        // Clamp time to valid range
        time = Math.max(0, Math.min(time, this.duration));

        const wasPlaying = this.isPlaying;

        // if (this.isPlaying) {
        //     this.pauseAudio();
        // }

        this.pauseTime = time;
        console.log("✅ Seeked to:", this.pauseTime);

        if (wasPlaying) {
            this.playAudio();
        }
    }

    getCurrentTime() {
        if (this.isPlaying) {
            return this.audioContext.currentTime - this.startTime;
        }
        return this.pauseTime;
    }

    updateTime() {
        if (!this.isMoving && this.audioBuffer && this.isPlaying) {
            const currentTime = this.getCurrentTime();
            const percentage = (currentTime / this.duration) * 100;

            // Update vinyl rotation
            this.vinyl_angle += 5;
            if (this.vinyl_angle >= 360) {
                this.vinyl_angle -= 360;
                this.vinyl.style.transition = "all 0s";
            } else {
                this.vinyl.style.transition = "all 0.5s";
            }
            this.vinyl.style.rotate = this.vinyl_angle + "deg";

            // Update progress circle
            setProgress(percentage);

            // Update time display
            let currentMinutes = Math.floor(currentTime / 60);
            let currentSeconds = Math.floor(currentTime % 60);
            this.timeDisplay.textContent = currentMinutes + ":" + (currentSeconds < 10 ? "0" + currentSeconds : currentSeconds);
        }
    }

    click(event) {
        if (event.button == 0) {
            console.log("🖱 left click detected!");
            this.isMoving = true;
            this.last_angle = 0;

            this.seekbar.addEventListener('mousemove', this.boundChangeSeek);
            document.addEventListener('mouseup', this.boundMouseup);
        }
    }

    mouseup(event) {
        console.log("Mouse up");

        this.seekbar.removeEventListener('mousemove', this.boundChangeSeek);
        document.removeEventListener('mouseup', this.boundMouseup);

        const X = event.offsetX - 100;
        const Y = (event.offsetY - 100) * (-1);
        let angle = Math.atan2(X, Y) * (180 / Math.PI);

        if (angle < 0) {
            angle = 360 + angle;
        }

        setProgressAngle(angle);
        let percent = angle / 360;
        let seekTime = percent * this.duration;

        console.log("Seeking to:", seekTime, "out of", this.duration);

        // Use the new seek method
        this.seekTo(seekTime);

        this.isMoving = false;
    }

    changeSeek(event) {
        if (!this.isMoving) return;

        const X = event.offsetX - 100;
        const Y = (event.offsetY - 100) * (-1);
        let angle = Math.atan2(X, Y) * (180 / Math.PI);

        if (angle < 0) {
            angle = 360 + angle;
        }

        this.vinyl_angle += angle - this.last_angle;
        this.last_angle = angle;
        this.vinyl.style.transition = "all 0.1s";
        this.vinyl.style.rotate = this.vinyl_angle + "deg";
        setProgressAngle(angle);
    }

    updatePlayButtonUI(playing) {
        const playButton = document.getElementById('playBt');

        if (playing) {
            playButton.classList.remove('fa-play');
            playButton.classList.add('fa-pause');
            if (this.songButton) {
                this.songButton.classList.remove('fa-play');
                this.songButton.classList.add('fa-pause');
            }
        } else {
            playButton.classList.remove('fa-pause');
            playButton.classList.add('fa-play');
            if (this.songButton) {
                this.songButton.classList.remove('fa-pause');
                this.songButton.classList.add('fa-play');
            }
        }
    }

    async play(id) {
        if (this.currentTrackID !== id) {
            const index = this.tracks.findIndex(t => t.id === id);
            if (index !== -1) {
                await this.loadTrack(index);
                this.currentTrackID = id;
                this.isPlaying = false;
            }
        }

        if (!this.isPlaying) {
            this.playAudio();
            this.updatePlayButtonUI(true);
        } else {
            this.pauseAudio();
            this.updatePlayButtonUI(false);
        }
    }

    setVolume(volume) {
        if (this.gainNode) {
            this.gainNode.gain.value = volume;
        }
    }

    async next() {
        this.currentTrackIndex = (this.currentTrackIndex + 1) % this.tracks.length;
        await this.loadTrack(this.currentTrackIndex);
        this.isPlaying = false;
        this.play(this.tracks[this.currentTrackIndex].id);
        setProgressAngle(0);
        this.vinyl_angle = 0;
    }

    async previous() {
        this.currentTrackIndex = (this.currentTrackIndex - 1 + this.tracks.length) % this.tracks.length;
        await this.loadTrack(this.currentTrackIndex);
        this.isPlaying = false;
        this.play(this.tracks[this.currentTrackIndex].id);
        setProgressAngle(0);
        this.vinyl_angle = 0;
    }
}

function setProgress(percentage) {
    // Ensure percentage is between 0 and 100
    percentage = Math.max(0, Math.min(100, percentage));

    // Calculate the angle for the conic gradient
    const angle = (percentage / 100) * 360;

    // Update the conic gradient
    progressCircle.style.background = `conic-gradient(
                #e17fe1 0deg,
                #e17fe1 ${angle}deg,
                #b3b3b3 ${angle}deg
            )`;
}

function setProgressAngle(angle) {
    // Update the conic gradient
    progressCircle.style.background = `conic-gradient(
                #e17fe1 0deg,
                #e17fe1 ${angle}deg,
                #b3b3b3 ${angle}deg
            )`;
}

function animateProgress() {
    let progress = 0;
    const interval = setInterval(() => {
        progress += 2;
        setProgress(progress);

        if (progress >= 100) {
            clearInterval(interval);
        }
    }, 50);
}

//Set Cookie
function setCookie(cname, cvalue) {
    document.cookie = cname + "=" + cvalue + ";";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


//---------------CODE STARTS FROM HERE-------------------
const player = new MusicPlayer(tracks);
const volume = Number(getCookie('volume'));
console.log(volume);
if (isNaN(volume)) {
    player.setVolume(0.5);
} else {
    player.setVolume(volume);
}
const volumeInput = document.createElement("input");
volumeInput.type = 'range';
volumeInput.min = 0;
volumeInput.max = 1;
volumeInput.step = 0.01;
volumeInput.classList.add('volume');
volumeInput.value = String(volume);
volumeControl.append(volumeInput);

//volumeBox.insertAdjacentHTML("beforeend", "<input class='volume' type='range' min='0' max='1' value ='"+ volume +"' step='0.01'>");


if (song_id) {
    const index = tracks.findIndex(t => t.id === song_id);
    console.log("Index of song: " + index);
    if (index != -1) {

        player.play(song_id);
    } else {
        player.play(0);
        alert("You did not upload a song you trying to play");
    }
}

volumeControl.addEventListener('input', (e) => {
    player.setVolume(e.target.value);
});

volumeControl.addEventListener('mouseup', (e) => {
    setCookie('volume', e.target.value);
})
