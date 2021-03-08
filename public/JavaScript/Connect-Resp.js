const connect = document.getElementById("connexion-responsive");
const connexion2 = document.querySelector(".connexion2");
const registerInscription = document.querySelector(".principal");
const connexionRespIndex = document.querySelector(".connexion-resp-index");
const phrase = document.querySelector(".phrase");

connect.addEventListener('click', () => {
    connexion2.classList.toggle("show");
    registerInscription.classList.toggle("show");
});