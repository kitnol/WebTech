removeTrackEvent();
addTrackEvent();

function addTrackEvent() {
  let add = document.querySelector(".add");
  add.addEventListener("click", e => {
    addTrack();
  });
}

function addTrack() {
  let newTrack = document.querySelector(".track").cloneNode(true);
  newTrack.querySelector("input").value = "";
  document.querySelector(".inputs").appendChild(newTrack);
  toggleRemoveButton();
}

function removeTrackEvent() {
  document.querySelector('.tracks').addEventListener('click', e=> {
    let target = e.target;
    if (!target.classList.contains("remove")) return;

    removeTrack(target);   
  });
}

function removeTrack(target) {
  target.parentNode.parentNode.removeChild(target.parentNode);
  toggleRemoveButton();
}

function toggleRemoveButton(){
  let tracks = document.querySelectorAll(".track");
  if(tracks.length > 1) {
    for (track of tracks) {
      track.querySelector("button").disabled = false;
    }
  }
  else {
    tracks[0].querySelector("button").disabled = true;
  }
}

// Fade out function for navbar navigation
function fadeOut(container, length) {
    if (container) {
        container.style.transition = 'opacity ' + length + 's ease-out, transform ' + length + 's ease-out';
        container.style.opacity = '0';
        container.style.transform = 'translateY(50px)';
    }
}

// Function to fade out and navigate on navbar click
function fadeOutAndNavigate(event, href) {
    event.preventDefault();
    const topinfo = document.getElementById('top-info');
    const cardcontainer = document.getElementById('card-container');
    if (topinfo && cardcontainer){
      fadeOut(cardcontainer, 0.35);
      setTimeout(() => {
      fadeOut(topinfo, 0.35);
      },300);
    } else{
    const main = document.querySelector('main');
    fadeOut(main, 0.5);
    }
    setTimeout(() => {
        window.location.href = href;
    }, 200);
}