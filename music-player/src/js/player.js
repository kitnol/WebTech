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
        this.vinyl_angle = 0;
        this.change_amount = 11;
        this.tracks = tracks;
        this.currentTrackIndex = 0;
        this.audio = new Audio();
        this.isPlaying = false;
        this.isMoving = false;
        this.last_angle = 0;

        this.audio = document.getElementById('audio');
        this.seekbar = document.getElementById('progressCircle');
        this.vinyl = document.getElementsByClassName('track-art')[0];
        //this.seekbar_cont = document.getElementsByClassName('seekbar-container');

        // Initialize seekbar
        this.audio.addEventListener('timeupdate', () => {
            if (this.isMoving) return;
            else {
                const percentage = (this.audio.currentTime / this.audio.duration);
                console.log(percentage * 100);
                this.vinyl_angle += 5;
                if (this.vinyl_angle >= 360) {
                    this.vinyl_angle -= 360;
                    this.vinyl.style.transition = "all 0s";
                }
                else {
                    this.vinyl.style.transition = "all 0.5s";
                }
                console.log(this.vinyl_angle);
                this.vinyl.style.rotate = this.vinyl_angle + "deg";
                setProgress(percentage * 100);
            }
        });

        // Handle seekbar click/drag
        this.seekbar.addEventListener('mousedown', (e) => this.click(e));
        //this.seekbar_cont[0].addEventListener('mousedown', (e) => this.seek(e));
        //this.seekbar_cont[0].addEventListener('click', (e) => this.seek(e));
        // this.seekbar_cont[0].addEventListener('mousedown', (e) => this.click(e));
        //this.audioElement.addEventListener('mousedown', (e) => this.seek(e));

    }

    click(event) {
        if (event.button == 2) {
            console.log("🖱 right click detected!")
            
            this.isMoving = true;
            this.seekbar.addEventListener('mousemove', (e) => this.changeSeek_DJ(e));
            this.seekbar.addEventListener('mouseup', (e) => this.mouseup(e));
        }
        if (event.button == 0) {
            console.log("🖱 left click detected!")
            this.isMoving = true;
            this.seekbar.addEventListener('mousemove', (e) => this.changeSeek(e));
            this.seekbar.addEventListener('mouseup', (e) => this.mouseup(e));
        }
    }

    mouseup(event) {
        console.log("Mouse up");
        this.isMoving = false;
        const X = event.offsetX - 100;
        const Y = (event.offsetY - 100) * (-1);
        let angle = Math.atan2(X, Y) * (180 / Math.PI);

        if (angle < 0) {
            angle = 360 + angle;
        }
        
        console.log(angle);
        setProgressAngle(angle);
        let percent = angle / 360;
        console.log("Percent: " + percent);
        this.audio.currentTime = percent * this.audio.duration;

        console.log("Set current time to " + this.audio.currentTime);
        this.seekbar.removeEventListener('mousemove', (e) => this.changeSeek(e));
        this.seekbar.removeEventListener('mouseup', (e) => this.mouseup(e))
        console.log(this.seekbar.removeEventListener('mouseup', (e) => this.mouseup(e)));
        audioElement.playbackRate=1.0;
        this.change_amount = 11;
    }

    // seek(event) {
    //     const X = event.offsetX - 100;
    //     const Y = (event.offsetY - 100) * (-1);
    //     let angle = Math.atan2(X, Y) * (180 / Math.PI);

    //     if (angle < 0) {
    //         angle = 360 + angle;
    //     }

    //     console.log(angle);
    //     setProgressAngle(angle);
    // }

    changeSeek(event) {
        if (!this.isMoving) {
            return;
        }
        else {
            const X = event.offsetX - 100;
            const Y = (event.offsetY - 100) * (-1);
            let angle = Math.atan2(X, Y) * (180 / Math.PI);
            
            if (angle < 0) {
                angle = 360 + angle;
            }

            this.vinyl_angle += angle - this.last_angle;
            //console.log("Vinyl: " + this.vinyl_angle + " Last: " + this.last_angle + " Angle: " + angle);
            this.last_angle = angle;
            this.vinyl.style.transition = "all 0.1s";
            this.vinyl.style.rotate = this.vinyl_angle + "deg";
            setProgressAngle(angle);
        }
    }
    
    changeSeek_DJ(event) {
        if (!this.isMoving) {
            return;
        }
        else {
            const X = event.offsetX - 100;
            const Y = (event.offsetY - 100) * (-1);
            let angle = Math.atan2(X, Y) * (180 / Math.PI);
            let change;

            if (angle < 0) {
                angle = 360 + angle;
            }
            
            change = this.last_angle - angle;
            if (change < 0) {
                change = change * (-1);

            }
            if (this.change_amount > 10) {
                audioElement.playbackRate=0.5;
                this.change_amount = 0;
            }
            this.change_amount += 1;
            console.log("Change: " + change);
            this.vinyl_angle += angle - this.last_angle;
            console.log("Vinyl: " + this.vinyl_angle + " Last: " + this.last_angle + " Angle: " + angle);
            this.last_angle = angle;
            this.vinyl.style.transition = "all 0.1s";
            this.vinyl.style.rotate = this.vinyl_angle + "deg";
            setProgressAngle(angle);
        }
    }

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
        }
        else {
            // Pause the track
            this.audio.pause();
            this.isPlaying = false;
            playButton.classList.remove('fa-pause');
            playButton.classList.add('fa-play');
        }
    }

    next() {
        // Move to the next track
        this.currentTrackIndex = (this.currentTrackIndex + 1) % this.tracks.length;
        this.loadTrack(this.currentTrackIndex);
        this.isPlaying = !this.isPlaying;
        this.play();
        setProgressAngle(0);
        this.vinyl_angle = 0;
        this.vinyl.style.transition = "all 0.5s";
        this.vinyl.style.rotate = this.vinyl_angle + "deg";
    }

    previous() {
        // Move to the previous track
        this.currentTrackIndex = (this.currentTrackIndex - 1 + this.tracks.length) % this.tracks.length;
        this.loadTrack(this.currentTrackIndex);
        this.isPlaying = !this.isPlaying;
        this.play();
        setProgressAngle(0);
        this.vinyl_angle = 0;
        this.vinyl.style.transition = "all 0.5s";
        this.vinyl.style.rotate = this.vinyl_angle + "deg";
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
}

function setProgressAngle(angle) {
    // Update the conic gradient
    progressCircle.style.background = `conic-gradient(
                #72f2cc 0deg,
                #72f2cc ${angle}deg,
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