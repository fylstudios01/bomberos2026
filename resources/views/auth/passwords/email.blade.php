@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Restablecimiento de Clave PDB</div>

                <div class="card-body text-center">

                    <p class="mb-4">
                        Si ha olvidado su clave de acceso, presione el botón debajo
                        para copiar el correo electronico y contacte con la Dirección de Comunicaciones solicitando el cambio de la misma.
                    </p>

                    <!-- Campo oculto con el correo a copiar -->
                    <input type="text" id="mailOculto"
                        value="comunicaciones@bomberosyerbabuena.com.ar"
                        style="opacity: 0; height: 0; border: none; padding: 0;">

                    <!-- BOTÓN CENTRADO -->
                    <div class="d-flex justify-content-center">
                        <button id="btnCopiar" onclick="copiarMail()" class="btn btn-primary px-4 py-2">
                            Copiar Mail de Contacto
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    function copiarMail() {
        let input = document.getElementById('mailOculto');
        let boton = document.getElementById('btnCopiar');

        // Seleccionar y copiar
        input.style.opacity = "1";
        input.select();
        input.setSelectionRange(0, 99999);
        document.execCommand("copy");
        input.style.opacity = "0";

        // Cambiar estilo del botón
        boton.classList.remove("btn-primary");
        boton.classList.add("btn-success");
        boton.innerText = "Mail Copiado Exitosamente";

        // Volver al estado original
        setTimeout(() => {
            boton.classList.remove("btn-success");
            boton.classList.add("btn-primary");
            boton.innerText = "Copiar Correo de Contacto";
        }, 2000);
    }
</script>

@endsection
