function editArtist() {
    document.getElementById('artist-info').style.display = 'none';
    document.getElementById('artist-edit').style.display = '';
}

function editPhoto() {
    document.getElementById('photo-info').style.display = 'none';
    document.getElementById('photo-edit').style.display = '';
}

function cancelPhoto() {
    document.getElementById('photo-info').style.display = '';
    document.getElementById('photo-edit').style.display = 'none';
}

function cancelArtist() {
    document.getElementById('artist-edit').style.display = 'none';
    document.getElementById('artist-info').style.display = '';
}
