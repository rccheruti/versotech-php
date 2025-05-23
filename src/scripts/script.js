
let nome = localStorage.getItem('nomeUsuario');

if (!nome) {
    nome = prompt("Qual é o seu nome?");
    if (nome) {
        localStorage.setItem('nomeUsuario', nome);
    }
}

if (nome) {
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

function aplicarDesaparecimento(alerta) {
    setTimeout(() => {
        alerta.style.opacity = '0';
        setTimeout(() => {
            alerta.remove();
        }, 1000);
    }, 3000);
}

const observer = new MutationObserver(mutations => {
    mutations.forEach(mutation => {
        mutation.addedNodes.forEach(node => {
            if (node.nodeType === 1 && node.classList.contains('alert')) {
                aplicarDesaparecimento(node);
            }
        });
    });
});

observer.observe(document.body, { childList: true, subtree: true });

document.querySelectorAll('.alert').forEach(alerta => {
    aplicarDesaparecimento(alerta);
});