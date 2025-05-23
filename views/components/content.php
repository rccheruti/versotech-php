<section class="container container-fluid text-center d-flex flex-column justify-content-center mt-5">
    <h3 class="mb-5"><strong id="welcomeNameUser">Usuário(a)</strong>, o que deseja fazer?</h3>
    <div class="d-grid gap-2 col-6 mx-auto">
        <a class="btn btn-primary" data-bs-toggle="modal" href="#usuariosModal" role="button">Usuários</a>
        <a class="btn btn-primary" data-bs-toggle="modal" href="#coresModal" role="button">Cores</a>
    </div>
</section>
<?php
@include 'usuarios.php';
@include 'cores.php';