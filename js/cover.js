function previewImage(input, preview) {
    input.addEventListener('change', () => {
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener('load', () => {
                preview.src = reader.result;
            });

            reader.readAsDataURL(file);
        }
    });

    preview.addEventListener('click', (event) => {
        event.preventDefault();
        input.click();
    });
}

const avatarInput = document.querySelector('#avatar');
const avatarPreview = document.querySelector('#avatar-preview');
previewImage(avatarInput, avatarPreview);

const coverInput = document.querySelector('#cover');
const coverPreview = document.querySelector('#cover-preview');
previewImage(coverInput, coverPreview);