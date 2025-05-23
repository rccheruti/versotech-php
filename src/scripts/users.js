$(document).ready(function () {
    const baseUrl = ''; // Se o index estiver na raiz, deixa vazio. Se estiver em uma subpasta, coloca, ex.: 'sistema'

    function getUrl(path) {
        return `${baseUrl}/requests/users/${path}`;
    }

    // Adicionar
    $('#userForm').submit(function (e) {
        e.preventDefault();

        const name = $('#name').val();
        const email = $('#email').val();
        const colorId = $('#colors').val();

        $.ajax({
            url: getUrl('user_store.php'),
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ name, email, color_id: colorId }),
            success: function (response) {
                if (response.status === 'success') {
                    alert('Usuário cadastrado!');
                    $('#userForm')[0].reset();
                    loadUsers();
                } else {
                    alert('Erro: ' + response.message);
                }
            }
        });
    });

    // Editar
    $(document).on('click', '.btn-edit', function () {
        const row = $(this).closest('tr');
        row.find('.user-name, .user-email, .user-color-name').addClass('d-none');
        row.find('.user-name-input, .user-email-input, .user-color-select').removeClass('d-none');

        row.find('.btn-edit, .btn-delete').addClass('d-none');
        row.find('.btn-save').removeClass('d-none');

        row.find('.btn-delete')
            .removeClass('btn-danger')
            .addClass('btn-secondary btn-cancel')
            .text('Cancelar');
    });

    // Salvar edição
    $(document).on('click', '.btn-save', function () {
        const row = $(this).closest('tr');
        const id = $(this).data('id');
        const name = row.find('.user-name-input').val();
        const email = row.find('.user-email-input').val();
        const colorId = row.find('.user-color-select').val();

        $.ajax({
            url: getUrl('user_edit.php'),
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ id, name, email, color_id: colorId }),
            success: function (response) {
                if (response.status === 'success') {
                    alert('Usuário atualizado!');
                    loadUsers();
                } else {
                    alert('Erro: ' + response.message);
                }
            }
        });
    });

    // Excluir
    $(document).on('click', '.btn-delete', function () {
        const id = $(this).data('id');
        if (confirm('Deseja excluir este usuário?')) {
            $.ajax({
                url: getUrl('user_delete.php'),
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ id }),
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Usuário removido!');
                        loadUsers();
                    } else {
                        alert('Erro: ' + response.message);
                    }
                }
            });
        }
    });

    // Cancelar edição
    $(document).on('click', '.btn-cancel', function () {
        const row = $(this).closest('tr');

        row.find('.user-name, .user-email, .user-color-name').removeClass('d-none');
        row.find('.user-name-input, .user-email-input, .user-color-select').addClass('d-none');

        row.find('.btn-edit, .btn-delete').removeClass('d-none');
        row.find('.btn-save').addClass('d-none');

        $(this)
            .removeClass('btn-secondary btn-cancel')
            .addClass('btn-danger')
            .text('Excluir');
    });

    // Atualizar a tabela
    function loadUsers() {
        $('#usersTable tbody').load(location.href + ' #usersTable tbody>*', '');
    }
});
