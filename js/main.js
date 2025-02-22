document.addEventListener("DOMContentLoaded", function () {
    console.log("✅ JavaScript cargado correctamente.");

    const form = document.getElementById("smsForm");
    if (!form) {
        console.error("❌ Error: No se encontró el formulario.");
        return;
    }

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        let numero = document.getElementById("numero").value.trim();
        let mensaje = document.getElementById("mensaje").value.trim();

        if (numero === "" || mensaje === "") {
            Swal.fire({
                icon: "warning",
                title: "Campos vacíos",
                text: "Por favor, completa todos los campos.",
            });
            return;
        }

        Swal.fire({
            title: "Enviando...",
            text: "Por favor, espera mientras se envía el mensaje.",
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch("sendSMS.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `numero=${encodeURIComponent(numero)}&mensaje=${encodeURIComponent(mensaje)}`
        })
        .then(response => {
            console.log("🔄 Respuesta cruda del servidor:", response);
            return response.json();
        })
        .then(data => {
            console.log("✅ JSON recibido:", data);

            Swal.close();
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "¡Mensaje Enviado!",
                    text: data.message,
                    confirmButtonText: "OK"
                });
                form.reset();
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error al Enviar",
                    text: data.message,
                    confirmButtonText: "Reintentar"
                });
            }
        })
        .catch(error => {
            console.error("🚨 Error en fetch():", error);
            Swal.fire({
                icon: "error",
                title: "Error de conexión",
                text: "No se pudo contactar con el servidor.",
                confirmButtonText: "Cerrar"
            });
        });
    });
});