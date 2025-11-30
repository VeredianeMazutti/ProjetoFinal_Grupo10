document.addEventListener("DOMContentLoaded", () => {
    const campos = document.querySelectorAll(
        "input, textarea, select"
    );

    campos.forEach(campo => {
        aplicarTema(campo);

        campo.addEventListener("input", () => aplicarTema(campo));
        campo.addEventListener("change", () => aplicarTema(campo));
        campo.addEventListener("blur", () => aplicarTema(campo));
    });
});

function aplicarTema(campo) {
    const valor = campo.value.trim();

    if (valor !== "") {
        aplicarClaro(campo);
    } else {
        aplicarEscuro(campo);
    }
}

function aplicarClaro(el) {
    el.style.backgroundColor = "#ffffff";
    el.style.color = "#000000";
    el.style.borderColor = "#c88cff";
    el.style.webkitTextFillColor = "#000000";
}

function aplicarEscuro(el) {
    el.style.backgroundColor = "#251435";
    el.style.color = "#ffffff";
    el.style.borderColor = "#9b5eff";
    el.style.webkitTextFillColor = "#ffffff";

    if (el.tagName === "SELECT") {
        el.style.backgroundImage =
            "url(\"data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 16 16'%3e%3cpath d='M3.204 5h9.592L8 10.481 3.204 5z'/%3e%3c/svg%3e\")";
    }
}
