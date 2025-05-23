
const nome = prompt("Qual seu nome?");

if(nome) {
    document.getElementById('welcomeNameUser').innerText = `${nome}`;
} else {
    document.getElementById('welcomeNameUser').innerText = 'Usuário(a)';
}

$.getScript("/src/scripts/users.js", function () {
    console.warn("users.js loaded");
});

$.getScript("/src/scripts/colors.js", function () {
    console.warn("colors.js loaded");
});