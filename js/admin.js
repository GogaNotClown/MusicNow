function addModalListeners(btnClass, modalClass, closeClass) {
    const btn = document.querySelector(btnClass);
    const modal = document.querySelector(modalClass);
    const close = modal.querySelectorAll(closeClass);

    btn.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    close.forEach(btn => {
        btn.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    });
}

addModalListeners('.btn-artist', '.modal-artist', '.modal-close');
addModalListeners('.btn-album', '.modal-album', '.modal-close');
addModalListeners('.btn-tracks', '.modal-tracks', '.modal-close');
addModalListeners('.btn-genre', '.modal-genre', '.modal-close');
addModalListeners('.btn-del-artist', '.modal-del-artist', '.modal-close');
addModalListeners('.btn-del-album', '.modal-del-album', '.modal-close');
addModalListeners('.btn-del-genre', '.modal-del-genre', '.modal-close');