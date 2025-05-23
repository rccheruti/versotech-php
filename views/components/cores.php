<div class="modal fade" id="coresModal" aria-hidden="true" aria-labelledby="coresModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="coresModalToggleLabel">Cores</h1>
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
                                <td>
                                    <span class="color-name"><?= htmlspecialchars($color['name']) ?></span>
                                    <input type="text" class="form-control form-control-sm color-input d-none" value="<?= htmlspecialchars($color['name']) ?>">
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning btn-edit" data-id="<?= $color['id'] ?>">Editar</button>
                                    <button class="btn btn-sm btn-success btn-save d-none" data-id="<?= $color['id'] ?>">Salvar</button>
                                    <button class="btn btn-sm btn-danger btn-delete" data-id="<?= $color['id'] ?>">Excluir</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>