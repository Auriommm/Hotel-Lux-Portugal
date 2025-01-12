// script.js
window.onload = function() {
    fetchStatistics();
};

function fetchStatistics() {
    fetch('get_statistics.php')  // Um arquivo PHP que retorna as estatísticas em JSON
        .then(response => response.json())
        .then(data => {
            document.getElementById('active-clients').textContent = data.active_clients;
            document.getElementById('occupied-rooms').textContent = data.occupied_rooms;
            document.getElementById('pending-reservations').textContent = data.pending_reservations;
        })
        .catch(error => console.error('Erro ao carregar as estatísticas:', error));
}

// script.js
document.getElementById('register-form').addEventListener('submit', function(e) {
    // Previne o envio do formulário para validação
    e.preventDefault();

    // Coleta os valores dos campos
    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;
    const num_identificacao = document.getElementById('num_identificacao').value;
    const contacto = document.getElementById('contacto').value;
    const password = document.getElementById('password').value;

    // Validação de campos
    if (nome.trim() === '') {
        alert('O nome não pode estar vazio.');
        return;
    }

    if (!validateEmail(email)) {
        alert('Por favor, insira um email válido.');
        return;
    }

    if (num_identificacao.trim() === '') {
        alert('O número de identificação não pode estar vazio.');
        return;
    }

    if (contacto.trim() === '') {
        alert('O contacto não pode estar vazio.');
        return;
    }

    if (password.length < 6) {
        alert('A senha deve ter pelo menos 6 caracteres.');
        return;
    }

    // Se tudo estiver correto, envia o formulário
    this.submit();  // Envia o formulário para o servidor
});

// Função para validar o formato do email
function validateEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return regex.test(email);
}

// script.js

// Validação do formulário de cadastro (registo.php)
document.getElementById('register-form').addEventListener('submit', function(e) {
    e.preventDefault();  // Previne o envio do formulário

    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;
    const num_identificacao = document.getElementById('num_identificacao').value;
    const contacto = document.getElementById('contacto').value;
    const password = document.getElementById('password').value;

    if (nome.trim() === '') {
        alert('O nome não pode estar vazio.');
        return;
    }

    if (!validateEmail(email)) {
        alert('Por favor, insira um email válido.');
        return;
    }

    if (num_identificacao.trim() === '') {
        alert('O número de identificação não pode estar vazio.');
        return;
    }

    if (contacto.trim() === '') {
        alert('O contacto não pode estar vazio.');
        return;
    }

    if (password.length < 6) {
        alert('A senha deve ter pelo menos 6 caracteres.');
        return;
    }

    this.submit();  // Envia o formulário
});

// Função de validação do email
function validateEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return regex.test(email);
}


// Validação do formulário de reserva (reservar.php)
document.getElementById('reservation-form').addEventListener('submit', function(e) {
    e.preventDefault();  // Previne o envio do formulário

    const quarto = document.getElementById('quarto').value;
    const checkin = document.getElementById('checkin').value;
    const checkout = document.getElementById('checkout').value;

    if (quarto === '') {
        alert('Por favor, selecione um quarto.');
        return;
    }

    if (!checkin || !checkout) {
        alert('Por favor, selecione as datas de check-in e check-out.');
        return;
    }

    if (new Date(checkout) <= new Date(checkin)) {
        alert('A data de check-out deve ser posterior à de check-in.');
        return;
    }

    this.submit();  // Envia o formulário
});

// script.js

// Validação do formulário de login (login.php)
document.getElementById('login-form').addEventListener('submit', function(e) {
    e.preventDefault();  // Previne o envio do formulário até a validação ser feita

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (!validateEmail(email)) {
        alert('Por favor, insira um e-mail válido.');
        return;
    }

    if (password.trim() === '') {
        alert('A senha não pode estar vazia.');
        return;
    }

    this.submit();  // Envia o formulário se tudo estiver correto
});

// Função para validar o formato do e-mail
function validateEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return regex.test(email);
}
