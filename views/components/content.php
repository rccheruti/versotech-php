<section class="container container-fluid mt-5 text-center">
    <h3 class="mb-5">O que deseja fazer?</h3>
    <a class="btn btn-primary" data-bs-toggle="modal" href="#usuariosModal" role="button">Usuários</a>
    <a class="btn btn-primary" data-bs-toggle="modal" href="#coresModal" role="button">Cores</a>
</section>
<?php
@include 'usuarios.php';
@include 'cores.php';