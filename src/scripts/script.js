jQuery(function ($) {

    $('#colorForm').on('submit', function (e) {
        e.preventDefault();

        const name = $('#nameColor').val();

        $.ajax({
            url: '/requests/color_store.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ name: name }),
            success: function (data) {
                const msgDiv = $('#responseMsg');
                if (data.status === 'success') {
                    msgDiv.html(`<div class="alert alert-success">${data.message}</div>`);
                    $('#colorForm')[0].reset();
                } else {
                    msgDiv.html(`<div class="alert alert-danger">${data.message}</div>`);
                }
            },
            error: function (xhr, status, error) {
                console.error('Erro:', error);
                $('#responseMsg').html(`<div class="alert alert-danger">Erro na requisição.</div>`);
            }
        });
    });


});