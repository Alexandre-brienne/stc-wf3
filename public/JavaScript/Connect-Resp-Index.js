const connectIndex = document.getElementById("connexion-responsive-button");
const connexionRespIndex = document.querySelector(".connexion-resp-index");
const phrase = document.querySelector(".phrase");

connectIndex.addEventListener('click', () => {
    connexionRespIndex.classList.toggle("show");
    phrase.classList.toggle("show");
});
