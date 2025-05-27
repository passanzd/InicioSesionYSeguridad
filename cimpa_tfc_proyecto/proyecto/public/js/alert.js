document.addEventListener("DOMContentLoaded", function () {
    // Ocultar mensajes después de 3 segundos
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.style.display = 'none';
        });
    }, 3000);


    // Validación de la contraseña
    document.getElementById("loginForm").addEventListener("submit", function (event) {
        let clave = document.getElementById("new_password").value.trim();
        let error = "";

        // Expresión regular: al menos 8 caracteres, una letra y un número
        let requisitoClave = /^(?=.*[A-Za-z])(?=.*\d).{8,}$/;


        if (!requisitoClave.test(clave)) {
            error = "La contraseña debe tener al menos 8 caracteres, incluyendo una letra y un número.";
        }

        if (error) {
            alert(error);
            event.preventDefault(); // Evita el envío si hay errores
        }
    });
});
