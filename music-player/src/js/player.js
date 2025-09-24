const title = document.getElementById('track-title');
const audioElement = document.getElementById('audio');
//const seekbar = document.getElementById('seekbar');
const playButton = document.getElementById('playBt');
const volumeControl = document.getElementById('volume');

const progressCircle = document.getElementById('progressCircle');
const progressText = document.getElementById('progressText');
const progressSlider = document.getElementById('progressSlider');

volumeControl.addEventListener('input', (e) => {
    player.audio.volume = e.target.value;
});

class MusicPlayer {
    constructor(tracks) {
        this.tracks = tracks;
        this.currentTrackIndex = 0;
        this.audio = new Audio();
        this.isPlaying = false;
        this.isMoving = false;

        this.audio = document.getElementById('audio');
        //this.seekbar = document.getElementById('seekbar');
        //this.seekbar_cont = document.getElementsByClassName('seekbar-container');

        // Initialize seekbar
        this.audio.addEventListener('timeupdate', () => {
            if (this.isMoving) return;
            else {
                const percentage = (this.audio.currentTime / this.audio.duration);
                console.log(percentage*100);
                //this.seekbar.style.height = (percentage * 100) + "%";
                setProgress(percentage * 100);
            }
        });

        // Handle seekbar click/drag
        //this.seekbar.addEventListener('click', (e) => this.seek(e));
        //this.seekbar_cont[0].addEventListener('mousedown', (e) => this.seek(e));
        //this.seekbar_cont[0].addEventListener('click', (e) => this.seek(e));
        // this.seekbar_cont[0].addEventListener('mousedown', (e) => this.click(e));
        //this.audioElement.addEventListener('mousedown', (e) => this.seek(e));

    }

    // click(event) {
    //     this.isMoving = true;
    //     this.seekbar_cont[0].addEventListener('mousemove', (e) => this.changeSeek(e));
    //     this.seekbar_cont[0].addEventListener('mouseup', (e) => this.mouseup(e));
    // }

    // mouseup(event) {
    //     console.log("Mouse up");
    //     this.isMoving = false;
    //     const percent = event.offsetY / this.seekbar_cont[0].offsetHeight;
    //     this.audio.currentTime = percent * this.audio.duration;

    //     console.log("Set current time to " + this.audio.currentTime);
    //     this.seekbar_cont[0].removeEventListener('mousemove', (e) => this.changeSeek(e));
    //     this.seekbar_cont[0].removeEventListener('mouseup', (e) => this.mouseup(e))
    //     console.log(this.seekbar_cont[0].removeEventListener('mouseup', (e) => this.mouseup(e)));
    // }

    seek(event) {
        const percent = event.offsetY / this.seekbar_cont[0].offsetHeight;
        this.audio.currentTime = percent * this.audio.duration;
        setProgress(Math.round(percent * 100));
        // this.seekbar.style.height = (percent * 100) + "%";
    }

    // changeSeek(event) {
    //     if (!this.isMoving) {
    //         return;
    //     }
    //     else {
    //         const percent = event.offsetY / this.seekbar_cont[0].offsetHeight;
    //         console.log(event.offsetX);
    //         console.log(percent);

    //         //this.audio.currentTime = percent * this.audio.duration;
    //         this.seekbar.style.height = (percent * 100) + "%";
    //     }
    // }

    loadTrack(index) {
        this.audio.src = this.tracks[index];
        this.audio.load();
        title.textContent = "Title: " + this.getCurrentTrack().substr(0, this.getCurrentTrack().length - 4);
    }

    play() {
        if (!this.isPlaying) {
            // Play the track
            this.audio.play();
            this.isPlaying = true;
            playButton.classList.remove('fa-play');
            playButton.classList.add('fa-pause');
            setProgress(10);
        }
        else {
            // Pause the track
            this.audio.pause();
            this.isPlaying = false;
            playButton.classList.remove('fa-pause');
            playButton.classList.add('fa-play');
        }
    }

    pause() {
        this.seekbar_cont[0].removeEventListener('mousemove', (e) => this.changeSeek(e));
    }

    next() {
        // Move to the next track
        this.currentTrackIndex = (this.currentTrackIndex + 1) % this.tracks.length;
        this.loadTrack(this.currentTrackIndex);
        this.isPlaying = !this.isPlaying;
        this.play();
        this.seekbar.value = 0;
    }

    previous() {
        // Move to the previous track
        this.currentTrackIndex = (this.currentTrackIndex - 1 + this.tracks.length) % this.tracks.length;
        this.loadTrack(this.currentTrackIndex);
        this.isPlaying = !this.isPlaying;
        this.play();
        this.seekbar.value = 0;
    }

    getCurrentTrack() {
        return this.tracks[this.currentTrackIndex];
    }

}

// Example usage
const tracks = [
    'track1.mp3',
    'Post Success Depression.mp3',
    "Trust Nobody.mp3"
];

const player = new MusicPlayer(tracks);
player.loadTrack(0);

// player.audio.addEventListener('timeupdate', () => {
//     console.log((player.audio.currentTime / player.audio.duration)*100);
//     seekbar.value = (player.audio.currentTime / player.audio.duration);
// });

function setProgress(percentage) {
    // Ensure percentage is between 0 and 100
    percentage = Math.max(0, Math.min(100, percentage));

    // Calculate the angle for the conic gradient
    const angle = (percentage / 100) * 360;

    // Update the conic gradient
    progressCircle.style.background = `conic-gradient(
                #72f2cc 0deg,
                #72f2cc ${angle}deg,
                #b3b3b3 ${angle}deg
            )`;

    // Update the text
    progressText.textContent = `${Math.round(percentage)}%`;

    // Update slider
    progressSlider.value = percentage;
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