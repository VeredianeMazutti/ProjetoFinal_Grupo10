// AJAX curtida/descurtida
document.addEventListener('DOMContentLoaded', function () {

    const btnCurtir = document.getElementById('curtir-btn');

    if (btnCurtir) {
        btnCurtir.addEventListener('click', function () {
            const projetoId = this.dataset.id;

            fetch('ajaxCurtir.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'idProjeto=' + projetoId
            })
                .then(response => response.json())
                .then(data => {
                    const icone = document.getElementById('curtida-icone');
                    const count = document.getElementById('curtidas-count');

                    if (data.curtido) {
                        icone.className = 'bi bi-heart-fill text-danger';
                    } else {
                        icone.className = 'bi bi-heart';
                    }

                    count.textContent = data.curtidas;
                });
        });
    }

});