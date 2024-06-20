<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/app.css">
    <title>Crud</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/app.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
 <nav><img src="/images/logo.png" height="50vh"></nav>
    <div class="container">
        <div class="row">
            <div class="col-12 table-responsive">
                <br />
                <h3 align="center" class="titulo"> Adicione um novo usuário para começar </h3>
                <br />
                <div align="center">
                    <button type="button" name="create_record" id="create_record" class="btn btn-custom"> <i class="bi bi-plus-square"></i> Adicionar</button>
                </div>
                <br />
                <table class="table table-striped table-bordered crud_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th width="180px">Ações</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="sample_form" class="form-horizontal">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Adicionar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span id="form_result"></span>
                            <div class="form-group">
                                <label>Nome : <span class="name-required">*</span></label>
                                <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome..." />
                            </div>
                            <div class="form-group">
                                <label>Email : <span class="name-required">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="email@endereço.com..."  />
                            </div>
                            <div class="form-group">
                                <label>Telefone : <span class="name-required">*</span></label>
                                <input type="text" name="telefone" id="telefone" class="form-control" placeholder="(99)99999-9999"  maxlength="15" />
                            </div>
                            <input type="hidden" name="action" id="action" value="Add" />
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <input type="submit" name="action_button" id="action_button" value="Adicionar" class="btn btn-custom" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="sample_form" class="form-horizontal">
                        <div class="modal-header">
                            <h5 class="modal-title2" id="ModalLabel">Confirmar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h4 align="center" style="margin:0;">Deseja mesmo atualizar?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" name="ok_button" id="ok_button" class="btn btn-custom">Sim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmModal2" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="sample_form" class="form-horizontal">
                        <div class="modal-header">
                            <h5 class="modal-title2" id="ModalLabel">Confirmar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h4 align="center" style="margin:0;">Deseja mesmo apagar?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" name="ok_button" id="ok_button2" class="btn btn-danger">Apagar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>
@include('mask_js');
@include('crud_js')

</html>