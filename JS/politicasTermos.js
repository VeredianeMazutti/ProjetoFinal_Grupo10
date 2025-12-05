// HABILITAR BOTÃO SOMENTE SE OS CHECKBOXES DE LGPD FOREM MARCADOS
const btn = document.getElementById("btnSalvar");
const termos = document.getElementById("aceitouTermos");
const politica = document.getElementById("aceitouPolitica");

function validarLGPD() {
    btn.disabled = !(termos.checked && politica.checked);
}

termos.addEventListener("change", validarLGPD);
politica.addEventListener("change", validarLGPD);