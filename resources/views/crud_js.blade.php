<script type="text/javascript">
    $(document).ready(function() {
        var table = $('.crud_datatable').DataTable({
            processing: true,
            serverSide: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/2.0.0/i18n/pt-BR.json',
            },
            ajax: "{{ route('pessoas.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'nome',
                    name: 'nome'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'telefone',
                    name: 'telefone'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });


        // Adicionar 
            $('#create_record').click(function() {
            $('.modal-title').text('Adicionar novo Registro');
            $('#action_button').val('Adicionar');
            $('#action').val('Adicionar');
            $('#form_result').html('');
            $('#nome').val('');
            $('#email').val('');
            $('#telefone').val('');

            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function(event) {
            event.preventDefault();
            var action_url = '';

            if ($('#action').val() == 'Adicionar') {
                if ($('#nome').val().length == 0) {
                    alert('Por favor insira um Nome!');
                    $('.name-required').css("display", "inline")
                    return;
                }
                if ($('#email').val().length == 0) {
                    alert('Por favor insira um E-mail!');
                    $('.email-required').css("display", "inline")
                    return;
                }
                if ($('#telefone').val().length == 0) {
                    alert('Por favor insira um Telefone!');
                    $('.telefone-required').css("display", "inline")
                    return;
                }
                if ($('#telefone').val().length < 15) {
                    alert('Por favor insira um Telefone válido!');
                    $('.telefone-required').css("display", "inline")
                    return;
                }
                action_url = "{{ route('pessoas.store') }}";
                location.reload();
            }
            if ($('#action').val() == 'Edit') {
                $('#confirmModal').modal('show');
                return

            }
            if ($('#action').val() == 'Edit-done') {

                action_url = "{{ route('pessoas.update') }}";
                location.reload();
            }


            $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: action_url,
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    console.log('success: ' + data);
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        $('#pessoa_table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        });

        // editar

        $(document).on('click', '.edit', function(event) {
            event.preventDefault();
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "/pessoas/edit/" + id + "/",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(data) {
                    console.log('success: ' + data);
                    $('#nome').val(data.result.nome);
                    $('#email').val(data.result.email);
                    $('#telefone').val(data.result.telefone);
                    $('#hidden_id').val(id);
                    $('.modal-title').text('Editar');
                    $('#action_button').val('Atualizar');
                    $('#action').val('Edit');

                    $('.editpass').hide();
                    $('#formModal').modal('show');

                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            })

        });

        let pessoa_id;

        $(document).on('click', '#ok_button', function() {
            $('#action').val('Edit-done');
            $('#sample_form').trigger('submit')
            $('#confirmModal').modal('show');
        });

        //remover
        $(document).on('click', '.delete', function() {
            pessoa_id = $(this).attr('id');
            $('#confirmModal2').modal('show');
        });

        $('#ok_button2').click(function() {
            $.ajax({
                url: "pessoas/destroy/" + pessoa_id,
                beforeSend: function() {
                    $('#ok_button').text('Removendo Registro...');
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        $('#pessoa_table').DataTable().ajax.reload();
                        location.reload();
                    }, 2000);
                }
            })
        });
    });
</script>