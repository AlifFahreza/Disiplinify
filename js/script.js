const password = document.getElementById('password'); // id dari input password
const showHide = document.getElementById('showHide'); // id span showHide dalam input group passwordp password

password.type = 'password'; // set type input password menjadi password
showHide.innerHTML = '<i class="fas fa-eye"></i>'; // masukan icon eye dalam icon bootstrap 5
showHide.style.cursor = 'pointer'; // ubah cursor menjadi pointer
// jadi ketika span di hover maka cursornya berubah pointer

showHide.addEventListener('click', () => {
// ketika span diclick
    if (password.type === 'password') {
        // jika type inputnya password
        password.type = 'text'; // ubah type menjadi text
        showHide.innerHTML = '<i class="fas fa-eye-slash"></i>'; // ubah icon menjadi eye slash
    } else {
        // jika type bukan password (text)
        showHide.innerHTML = '<i class="fas fa-eye"></i>'; // ubah icon menjadi eye
        password.type = 'password'; // ubah type menjadi password
    }
});