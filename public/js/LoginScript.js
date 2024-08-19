//Login

const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');
const inscrire = document.getElementById('inscrire');
const connecter = document.getElementById('connecter');

registerBtn.addEventListener('click', () => {
    container.classList.add("activer");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("activer");
});
inscrire.addEventListener('click', () => {
    container.classList.add("activer");
});
connecter.addEventListener('click', () => {
    container.classList.remove("activer");
});

//Card