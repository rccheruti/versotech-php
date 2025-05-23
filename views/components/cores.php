<div class="modal fade" id="coresModal" aria-hidden="true" aria-labelledby="coresModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="coresModalToggleLabel">Cores</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Aqui você pode cadastrar ou listar as cores
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#cadastraCores" data-bs-toggle="modal">Cadastrar</button>
                <button class="btn btn-primary" data-bs-target="#listaCores" data-bs-toggle="modal">Listar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cadastraCores" aria-hidden="true" aria-labelledby="cadastraCoresLabel" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="cadastraCoresLabel">Cadastro de cores</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="colorForm">
                    <div class="row g-3">
                        <div class="col">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nameColor" name="nameColor" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>
                <div id="responseMsg" class="mt-3"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#coresModal" data-bs-toggle="modal">Volta ao inicio</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="listaCores" aria-hidden="true" aria-labelledby="listaCoresLabel" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="listaCoresLabel">Listagem de cores</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($colors as $color): ?>
                        <tr>
                            <td><?= htmlspecialchars($color['id']) ?></td>
                            <td><?= htmlspecialchars($color['name']) ?></td>
                            <td>
                                <a href="editar.php?id=<?= $color['id'] ?>" class="btn btn-sm btn-warning me-2">Editar</a>
                                <a href="excluir.php?id=<?= $color['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#coresModal" data-bs-toggle="modal">Volta ao inicio</button>
            </div>
        </div>
    </div>
</div>
