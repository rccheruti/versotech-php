jQuery(function ($) {
    const baseUrl = ''; // Se o index estiver na raiz, deixa vazio. Se estiver em uma subpasta, coloca, ex.: 'sistema'

    function getUrl(path) {
        return `${baseUrl}/requests/colors/${path}`;
    }

    // Adicionar cor
    $('#colorForm').on('submit', function (e) {
        e.preventDefault();

        const name = $('#nameColor').val();

        $.ajax({
            url: getUrl('color_store.php'),
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ name }),
            success: function (data) {
                const msgDiv = $('#responseMsg');
                if (data.status === 'success') {
                    msgDiv.html(`<div class="alert alert-success">${data.message}</div>`);
                    $('#colorForm')[0].reset();

                    $('table tbody').append(`
                        <tr>
                            <td>${data.id}</td>
                            <td>
                                <span class="color-name">${name}</span>
                                <input type="text" class="form-control form-control-sm color-input d-none" value="${name}">
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning btn-edit" data-id="${data.id}">Editar</button>
                                <button class="btn btn-sm btn-success btn-save d-none" data-id="${data.id}">Salvar</button>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="${data.id}">Excluir</button>
                            </td>
                        </tr>
                    `);

                    $('#cadastraCores').modal('hide');
                } else {
                    msgDiv.html(`<div class="alert alert-danger">${data.message}</div>`);
                }
            },
            error: function () {
                $('#responseMsg').html(`<div class="alert alert-danger">Erro na requisição.</div>`);
            }
        });
    });

    // Editar cor
    $('.table').on('click', '.btn-edit', function () {
        const row = $(this).closest('tr');
        row.find('.color-name').addClass('d-none');
        row.find('.color-input').removeClass('d-none');

        row.find('.btn-edit').addClass('d-none');
        row.find('.btn-save').removeClass('d-none');

        const btnDelete = row.find('.btn-delete');
        btnDelete.removeClass('btn-danger btn-delete').addClass('btn-secondary btn-cancel');
        btnDelete.text('Cancelar');
    });

    // Ao clicar em "Salvar" na edição da cor
    $('.table').on('click', '.btn-save', function () {
        const row = $(this).closest('tr');
        const id = $(this).data('id');
        const newName = row.find('.color-input').val();

        if (newName === '') {
            alert('O nome da cor não pode estar vazio.');
            return;
        }

        $.ajax({
            url: getUrl('color_edit.php'),
            type: 'POST',
            data: { id: id, name: newName },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    row.find('.color-name').text(newName).removeClass('d-none');
                    row.find('.color-input').addClass('d-none');

                    row.find('.btn-edit').removeClass('d-none');
                    row.find('.btn-save').addClass('d-none');

                    const btnCancel = row.find('.btn-cancel');
                    btnCancel.removeClass('btn-secondary btn-cancel').addClass('btn-danger btn-delete');
                    btnCancel.text('Excluir');

                    alert(response.message);
                } else {
                    alert('Erro: ' + response.message);
                }
            },
            error: function () {
                alert('Erro na requisição.');
            }
        });
    });

    // Cancelar edição
    $('.table').on('click', '.btn-cancel', function () {
        const row = $(this).closest('tr');

        row.find('.color-name').removeClass('d-none');
        row.find('.color-input').addClass('d-none');

        row.find('.btn-edit').removeClass('d-none');
        row.find('.btn-save').addClass('d-none');

        const btnCancel = row.find('.btn-cancel');
        btnCancel.removeClass('btn-secondary btn-cancel').addClass('btn-danger btn-delete');
        btnCancel.text('Excluir');
    });

    // Excluir cor
    $('.table').on('click', '.btn-delete', function () {
        const id = $(this).data('id');
        const row = $(this).closest('tr');

        if (confirm('Tem certeza que deseja excluir?')) {
            $.ajax({
                url: getUrl('color_delete.php'),
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ id }),
                success: function (response) {
                    if (response.status === 'success') {
                        row.remove();
                        alert(response.message);
                    } else {
                        alert('Erro: ' + response.message);
                    }
                },
                error: function () {
                    alert('Erro na requisição.');
                }
            });
        }
    });
});
