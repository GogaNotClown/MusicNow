let currentAudio = null;
let currentButton = null;
let currentTime = null;
const playButtons = document.querySelectorAll('.play-button');

playButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const src = button.dataset.src;
        const volumeRange = button.parentNode.querySelector('.volume-range');
        if (currentAudio && !currentAudio.paused) {
            if (button !== currentButton) {
                currentAudio.pause();
                currentAudio.currentTime = 0;
                currentAudio.removeEventListener('ended', onAudioEnded);
                currentAudio = null;
                currentButton.innerHTML = '<i class="ri-play-mini-fill"></i>';
                currentTime = null;
            } else {
                currentAudio.pause();
                currentButton.innerHTML = '<i class="ri-play-mini-fill"></i>';
                currentTime = currentAudio.currentTime;
                return;
            }
        }
        if (!currentAudio) {
            currentAudio = new Audio();
            currentAudio.src = src;
            currentAudio.volume = volumeRange.value;
            if (currentTime) {
                currentAudio.currentTime = currentTime;
            }
            currentAudio.play();
            button.innerHTML = '<i class="ri-pause-mini-fill"></i>';
            currentButton = button;
            currentAudio.addEventListener('ended', onAudioEnded);
        } else {
            currentAudio.src = src;
            currentAudio.volume = volumeRange.value;
            if (currentTime) {
                currentAudio.currentTime = currentTime;
            }
            currentAudio.play();
            button.innerHTML = '<i class="ri-pause-mini-fill"></i>';
            currentButton = button;
            currentAudio.removeEventListener('ended', onAudioEnded);
            currentAudio.addEventListener('ended', onAudioEnded);
        }
        volumeRange.addEventListener('input', () => {
            currentAudio.volume = volumeRange.value;
        });
    });
});

function onAudioEnded() {
    const currentIndex = Array.from(playButtons).indexOf(currentButton);
    const nextIndex = (currentIndex + 1) % playButtons.length;
    const nextButton = playButtons[nextIndex];
    const nextSrc = nextButton.dataset.src;
    const currentTrackInfo = document.getElementById("current-track-info");
    currentTrackInfo.innerHTML = "Сейчас играет: " + nextButton.dataset.title + " - " + nextButton.dataset.artist;
    currentAudio.src = nextSrc;
    currentAudio.play();
    currentButton.innerHTML = '<i class="ri-play-mini-fill"></i>';
    currentButton = nextButton;
    currentButton.innerHTML = '<i class="ri-pause-mini-fill"></i>';
    currentAudio.removeEventListener('ended', onAudioEnded);
    currentAudio.addEventListener('ended', onAudioEnded);
    updateTrackInfo();
}

function updateTrackInfo() {
    const currentTrackInfo = document.getElementById("current-track-info");
    if (currentAudio && currentAudio.duration) {
        currentTrackInfo.innerHTML = "Сейчас играет: " + currentButton.dataset.title + " - " + currentButton.dataset.artist + " (" + formatTime(currentAudio.currentTime) + "/" + formatTime(currentAudio.duration) + ")";
    }
}

setInterval(updateTrackInfo, 1000);

function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = Math.floor(seconds % 60);
    return minutes + ":" + (remainingSeconds < 10 ? "0" : "") + remainingSeconds;
}

const modals = {
    '.btn-edit': '.modal-edit',
    '.create-playlist': '.modal-create',
    '.btn-artist': '.modal-artist'
};

function addModalListeners(selector, modal) {
    const btn = document.querySelector(selector);
    const modalElement = document.querySelector(modal);
    const modalCloseButtons = modalElement.querySelectorAll('.modal-close');
    btn.addEventListener('click', () => {
        modalElement.style.display = 'block';
    });
    modalCloseButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            modalElement.style.display = 'none';
        });
    });
}

for (let selector in modals) {
    addModalListeners(selector, modals[selector]);
}

function showAlbums() {
    let albums = document.querySelectorAll('.albums .album');
    for (let i = 5; i < albums.length; i++) {
        albums[i].style.display = 'block';
    }
    document.querySelector('.all-desc-albums').innerHTML = 'Скрыть';
    document.querySelector('.all-desc-albums').onclick = hideAlbums;
}

function hideAlbums() {
    let albums = document.querySelectorAll('.albums .album');
    for (let i = 5; i < albums.length; i++) {
        albums[i].style.display = 'none';
    }
    document.querySelector('.all-desc-albums').innerHTML = 'Показать все';
    document.querySelector('.all-desc-albums').onclick = showAlbums;
}

function showArtists() {
    let artists = document.querySelectorAll('.artists .artist');
    for (let i = 5; i < artists.length; i++) {
        artists[i].style.display = 'block';
    }
    document.querySelector('.all-desc-artists').innerHTML = 'Скрыть';
    document.querySelector('.all-desc-artists').onclick = hideArtists;
}

function hideArtists() {
    let artists = document.querySelectorAll('.artists .artist');
    for (let i = 5; i < artists.length; i++) {
        artists[i].style.display = 'none';
    }
    document.querySelector('.all-desc-artists').innerHTML = 'Показать все';
    document.querySelector('.all-desc-artists').onclick = showArtists;
}