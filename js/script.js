
$(document).ready(function () {

    console.log("Documento listo y script.js cargado.");

    const dataTableOptions = {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        },
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
        pageLength: 10 
    };

    if ($('#tablaLibros').length) {
        try {
             $('#tablaLibros').DataTable(dataTableOptions);
             console.log("DataTables inicializado para #tablaLibros");
        } catch(e) {
            console.error("Error inicializando DataTables para #tablaLibros:", e);
        }
    }

    if ($('#tablaAutores').length) {
       try {
            $('#tablaAutores').DataTable(dataTableOptions);
            console.log("DataTables inicializado para #tablaAutores");
        } catch(e) {
            console.error("Error inicializando DataTables para #tablaAutores:", e);
        }
    }


    const formContacto = document.getElementById('formContacto'); 

    if (formContacto) {
        formContacto.addEventListener('submit', function (event) {
            console.log("Validando formulario de contacto...");

            let esValido = true;
            const nombre = document.getElementById('nombre');
            const correo = document.getElementById('correo');
            const asunto = document.getElementById('asunto');
            const comentario = document.getElementById('comentario');
            const campos = [nombre, correo, asunto, comentario];
            const errorDivId = 'error-validacion-cliente'; 
            let errorDiv = document.getElementById(errorDivId);

            campos.forEach(campo => {
                if (campo) campo.classList.remove('is-invalid');
            });
            if (errorDiv) errorDiv.remove();
            campos.forEach(campo => {
                if (campo && campo.value.trim() === '') {
                    esValido = false;
                    campo.classList.add('is-invalid');
                }
            });

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (correo && correo.value.trim() !== '' && !emailRegex.test(correo.value.trim())) {
                esValido = false;
                correo.classList.add('is-invalid');
            }

            if (!esValido) {
                console.log("Formulario NO válido (cliente).");
                event.preventDefault();

                errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-danger mt-3';
                errorDiv.id = errorDivId;
                errorDiv.role = 'alert';
                errorDiv.textContent = 'Por favor, revise los campos marcados en rojo.';
                formContacto.insertAdjacentElement('beforebegin', errorDiv);

            } else {
                 console.log("Formulario válido (cliente), permitiendo envío...");
                 const submitButton = formContacto.querySelector('button[type="submit"]');
                 if(submitButton) {
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...'; // Añadir spinner
                 }
            }
        });
    }

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    if (tooltipList.length > 0) {
        console.log("Tooltips de Bootstrap inicializados.");
    }


});