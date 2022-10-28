@section('title', 'Clientes')
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 d-grid d-md-block">
                                <h4 class="title fw-bold mb-0">
                                    Lista de Clientes
                                </h4>
                            </div>

                            <div class="col-6 d-grid d-md-flex justify-content-md-end">
                                @if(Auth::user()->utype == 'admin')
                                <a href="{{ route('dashboard.clients.add') }}" class="btn btn-sm btn-outline-dark mb-0">
                                    <i class="fas fa-user-tie text-warning"></i>&nbsp;
                                    Novo Cliente
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body" wire:ignore>
                        <div class="col-md-12">
                            @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                            @endif
                            <div class="table-responsive">

                                <table class="table table-striped table-hover" id="userList" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nome</th>
                                            <th>Cpf/Cnpj</th>
                                            <th>E-Mail</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clients as $client)
                                        <tr>
                                            <td>{{ $client->id }}</td>
                                            <td>{{ $client->name }}</td>
                                            <td class="cpf_cnpj">{!! $client->cpfcnpj !!}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-outline-dark m-0" title="Vizualizar">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('dashboard.clients.edit', $client->id) }}" class="btn btn-sm btn-outline-warning m-0" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger btn-sm m-0"
                                                    title="Deletar" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop{{ $client->id }}"">
                                                    <i class=" fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- modal excluir -->
                                        <div class="modal fade" id="staticBackdrop{{ $client->id }}" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Excluir Cliente
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Deseja realmente excluir o cliente
                                                            <strong>{{ $client->name }}</strong>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="button" class="btn btn-danger"
                                                            wire:click="delete({{ $client->id }})">Excluir</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal excluir -->
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <x-export-button />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src=" {{ asset('assets/js/jquery.mask.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#userList').DataTable({
        drawCallback: function() {
            $('.page-link').addClass('btn-sm text-dark');
            $('.page-item.active .page-link').addClass('bg-dark text-white border-dark');
            $('.dataTables_empty').addClass('lead');
        },
        responsive: true,
        columnDefs: [{
            orderable: false,
            targets: [4]
        }],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nenhum registro encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(filtrado de _MAX_ registros no total)",
            "search": "Pesquisar",
            "paginate": {
                "previous": "Anterior",
                "next": "Próximo"
            }
        }
    });
});


var cpfMascara = function(val) {
        return val.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-00';
    },
    cpfOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(cpfMascara.apply({}, arguments), options);
        }
    };
$('.cpf_cnpj').mask(cpfMascara, cpfOptions);
$('.telefone').mask('(00) 00000-0000');
</script>

<script>
window.addEventListener('hideModal', event => {
    $('.modal').modal('hide');
});
</script>
@endsection
