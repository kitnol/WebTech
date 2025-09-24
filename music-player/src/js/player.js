const title = document.getElementById('track-title');
const audioElement = document.getElementById('audio');
const seekbar = document.getElementById('seekbar');
const playButton = document.getElementById('playBt');
const volumeControl = document.getElementById('volume');

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
        this.seekbar = document.getElementById('seekbar');
        this.seekbar_cont = document.getElementsByClassName('seekbar-container');

        // Initialize seekbar
        this.audio.addEventListener('timeupdate', () => {
            const percentage = (this.audio.currentTime / this.audio.duration);
            this.seekbar.style.width = (percentage * 100) + "%";
        });

        // Handle seekbar click/drag
        //this.seekbar.addEventListener('click', (e) => this.seek(e));
        //this.seekbar_cont[0].addEventListener('mousedown', (e) => this.seek(e));
        //this.seekbar_cont[0].addEventListener('click', (e) => this.seek(e));
        this.seekbar_cont[0].addEventListener('mousedown', (e) => this.click(e));
        //this.audioElement.addEventListener('mousedown', (e) => this.seek(e));
    
    }

    click(event){
        this.isMoving = true;
        this.seekbar_cont[0].addEventListener('mousemove', (e) => this.changeSeek(e));
        this.seekbar_cont[0].addEventListener('mouseup', (e) => this.mouseup(e));
    }

    mouseup(event){
        console.log("Mouse up");
        this.isMoving = false;
        const percent = event.offsetX / this.seekbar_cont[0].offsetWidth;
        this.audio.currentTime = percent * this.audio.duration;
        this.seekbar.style.width = (percent * 100) + "%";
        console.log("Set current time to " + this.audio.currentTime);
        this.seekbar_cont[0].removeEventListener('mousemove', (e) => this.changeSeek(e));
        console.log("Removed mousemove");
        this.seekbar_cont[0].removeEventListener('mouseup', (e) => this.mouseup(e))
        console.log(this.seekbar_cont[0].removeEventListener('mouseup', (e) => this.mouseup(e)));
    }

    seek(event) {
        const percent = event.offsetX / this.seekbar_cont[0].offsetWidth;
        this.audio.currentTime = percent * this.audio.duration;
        this.seekbar.style.width = (percent * 100) + "%";
    }

    changeSeek(event) {
        if(!this.isMoving)
        {
            return;
        }
        else{
            const percent = event.offsetX / this.seekbar_cont[0].offsetWidth;
            console.log(event.offsetX);
            console.log(percent);
    
            //this.audio.currentTime = percent * this.audio.duration;
            this.seekbar.style.width = (percent * 100) + "%";
        }
    }

    loadTrack(index) {
        this.audio.src = this.tracks[index];
        this.audio.load();
        title.textContent = "Title: " +  this.getCurrentTrack().substr(0, this.getCurrentTrack().length - 4);
    }

    play() {
        if (!this.isPlaying) {
            // Play the track
            this.audio.play();
            this.isPlaying = true;
            playButton.classList.remove('fa-play');
            playButton.classList.add('fa-pause');
        }
        else{
            // Pause the track
            this.audio.pause();
            this.isPlaying = false;
            playButton.classList.remove('fa-pause');
            playButton.classList.add('fa-play');
        }
    }

    pause(){
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