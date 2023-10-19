@section('title', 'Usuários')
<div>
<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 d-grid d-md-block">
                                <h4 class="mb-0 title fw-bold">Listagem de Usuários</h4>
                            </div>
                            <div class="col-6 d-grid d-md-flex justify-content-md-end">
                                @if(Auth::user()->utype == 'admin' && auth()->user()->can('master'))
                                <a href="{{ route('dashboard.routes.add') }}" class="mb-0 btn btn-sm btn-outline-dark">
                                    <i class="fas fa-route text-warning"></i>&nbsp;
                                    Novo usuário
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body" wire:ignore>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tableUser">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Usuário</th>
                                        <th>Tipo de Acesso</th>
                                        <th>Permissão</th>
                                        <th>Criado</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->login }}</td>
                                        <td>{{ $user->utype }}</td>
                                        <td>{{ $user->roles[0]->name }}</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            @if($user->is_active == '1')
                                            <span class="badge bg-success">Ativo</span>
                                            @else
                                            <span class="badge bg-danger">Inativo</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="m-0 btn btn-sm btn-outline-dark"
                                                title="Visualizar" wire:click="show({{ $user->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @if (auth()->user()->can('master'))
                                                <a href="{{ route('dashboard.routes.edit', [$user->id])}}" class="m-0 btn btn-sm btn-outline-warning" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="m-0 btn btn-outline-danger btn-sm" title="Deletar" wire:click="delete({{ $user->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <x-export-button />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal-component />
</div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#tableUser').DataTable({
                drawCallback: function () {
                    $('.page-link').addClass('btn-sm text-dark');
                    $('.page-item.active .page-link').addClass('bg-dark text-white border-dark');
                    $('.dataTables_empty').addClass('lead');
                },
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [6] }
                ],
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

        window.addEventListener('showModal', event => {
            $('#showModal').modal('show');
            $('#showModalLabel').html(event.detail.package.code);
            let package = event.detail.package;
            let payOnDelivery = package.pay_on_delivery == 1 ? 'Sim' : 'Não';
            let data = dataTimeBr(package.created_at);
            $('#showModalBody').html(" " +
                "<p><strong>Destino: </strong>" + package.destiny_name + "</p>" +
                "<p><strong>Valor: </strong> R$ " + package.value + "</p>" +
                "<p><strong>Forma de pagamento: </strong>" + package.payment_method_name + "</p>" +
                "<p><strong>Pagamento no destino: </strong>" + payOnDelivery + "</p>" +
                "<p><strong>Criado por: </strong>" + package.client_name + "</p>" +
                "<p><strong>Criado em: </strong>" + data + "</p>");
            $('#showModalButtons').html(" " +
                "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>");
        });

        function dataTimeBr(data) {
            var data = data.split('-');
            return data[2].split(' ')[0] + '/' + data[1] + '/' + data[0] + ' ' + data[2].split(' ')[1];
        }
    </script>
@endsection
