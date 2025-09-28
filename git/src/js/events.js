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