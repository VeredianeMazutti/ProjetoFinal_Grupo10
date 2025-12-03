document.addEventListener("DOMContentLoaded", function() {
    // Pré-visualização do perfil
    const inputFotoPerfil = document.getElementById('fotoPerfil');
    const previewFoto = document.getElementById('previewFoto');

    if (inputFotoPerfil && previewFoto) {
        inputFotoPerfil.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                previewFoto.src = URL.createObjectURL(file);
            }
        });
    }

    // Pré-visualização do parceiro
    const inputImagem = document.getElementById('imagem');
    const previewImagem = document.getElementById('previewImagem');

    if (inputImagem && previewImagem) {
        inputImagem.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                previewImagem.src = URL.createObjectURL(file);
            }
        });
    }
});
