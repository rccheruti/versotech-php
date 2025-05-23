<div class="modal fade" id="usuariosModal" aria-hidden="true" aria-labelledby="usuariosModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Usuários</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cores</label>
                            <select class="form-select" aria-label="cores" id="colors">
                                <option selected>Selecione uma cor</option>
                                <?php
                                $colors = $colorController->getColors();
                                foreach ($colors as $color): ?>
                                    <option value="<?= $color['id'] ?>" id="<?= $color['id'] ?>"><?= $color['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped" id="usersTable">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Cor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['id']) ?></td>
                                <td>
                                    <span class="user-name"><?= htmlspecialchars($user['name']) ?></span>
                                    <input type="text" class="form-control form-control-sm user-name-input d-none" value="<?= htmlspecialchars($user['name']) ?>">
                                </td>
                                <td>
                                    <span class="user-email"><?= htmlspecialchars($user['email']) ?></span>
                                    <input type="email" class="form-control form-control-sm user-email-input d-none" value="<?= htmlspecialchars($user['email']) ?>">
                                </td>
                                <td>
                                    <span class="user-color-name"><?= htmlspecialchars($user['color_name']) ?></span>
                                    <select class="form-select form-select-sm user-color-select d-none">
                                        <?php foreach ($colors as $color): ?>
                                            <option value="<?= htmlspecialchars($color['id']) ?>" <?= $color['id'] == $user['color_id'] ? 'selected' : '' ?>><?= htmlspecialchars($color['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning btn-edit" data-id="<?= $user['id'] ?>">Editar</button>
                                    <button class="btn btn-sm btn-success btn-save d-none" data-id="<?= $user['id'] ?>">Salvar</button>
                                    <button class="btn btn-sm btn-danger btn-delete" data-id="<?= $user['id'] ?>">Excluir</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.location.reload()">Fechar</button>
            </div>
        </div>
    </div>
</div>