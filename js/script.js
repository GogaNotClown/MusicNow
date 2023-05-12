const btnRegister = document.querySelector('.btn-register');
const modalRegister = document.querySelector('.modal-register');
const btnLogin = document.querySelector('.btn-login');
const modalLogin = document.querySelector('.modal-login');
const modalClose = document.querySelectorAll('.modal-close');

btnRegister.addEventListener('click', () => {
    modalRegister.style.display = 'block';
});

btnLogin.addEventListener('click', () => {
    modalLogin.style.display = 'block';
});

modalClose.forEach(btn => {
    btn.addEventListener('click', () => {
        modalRegister.style.display = 'none';
        modalLogin.style.display = 'none';
    });
})