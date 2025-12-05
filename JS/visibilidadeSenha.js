// Alternar visibilidade da senha no login
const senhaLogin = document.getElementById('senha');
const toggleSenhaLogin = document.getElementById('toggleSenhaLogin');

toggleSenhaLogin.addEventListener('click', () => {
    if (senhaLogin.type === 'password') {
        senhaLogin.type = 'text';
        toggleSenhaLogin.textContent = '🔒'; 
    } else {
        senhaLogin.type = 'password';
        toggleSenhaLogin.textContent = '👁️';
    }
});
