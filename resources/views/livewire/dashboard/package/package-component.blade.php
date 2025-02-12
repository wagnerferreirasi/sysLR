@section('title', 'Pacotes')
@section('styles')

@endsection
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 d-grid d-md-block">
                                <h4 class="mb-0 title fw-bold">Listagem de Pacotes</h4>
                            </div>
                            <div class="col-6 d-grid d-md-flex justify-content-md-end">
                                @if(Auth::user()->utype == 'admin')
                                <a href="{{ route('dashboard.packages.add') }}"
                                    class="mb-0 btn btn-sm btn-outline-dark">
                                    <i class="fas fa-box text-warning"></i>&nbsp;
                                    Novo pacotes
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            @if (session()->has('message'))
                            <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body" wire:ignore>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tablePlace">
                                <thead>
                                    <tr>
                                        <th>Lr Code</th>
                                        <th>Loja</th>
                                        <th>Destino</th>
                                        <th>Valor</th>
                                        <th>Criado por</th>
                                        <th>Criado em</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($packages as $package)
                                    <tr>
                                        <td>{{ $package->code }}</td>
                                        <td>{{ $package->place->name }}</td>
                                        <td>{{ $package->destiny->name }}</td>
                                        <td>
                                            {{ $package->detail->value }}
                                        </td>
                                        <td>{{ $package->user->name }}</td>
                                        <td>{{ $package->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <button type="button" class="m-0 btn btn-sm btn-outline-dark"
                                                title="Visualizar" wire:click="show({{ $package->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <!-- button print -->
                                            <button type="button" class="m-0 btn btn-sm btn-outline-success"
                                                title="Imprimir" wire:click="print({{ $package->id }})">
                                                <i class="fas fa-print"></i>
                                            </button>
                                            <a href="" class="m-0 btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="m-0 btn btn-outline-danger btn-sm"
                                                title="Deletar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
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
    <x-print-component />

</div>
@section('scripts')
<script>
$(document).ready(function() {
    $('#tablePlace').DataTable({
        drawCallback: function() {
            $('.page-link').addClass('btn-sm text-dark');
            $('.page-item.active .page-link').addClass('bg-dark text-white border-dark');
            $('.dataTables_empty').addClass('lead');
        },
        order: [
            [5, 'desc']
        ],
        responsive: true,
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
    $('#showModalLabel').html(event.detail.user.code);
    let package = event.detail.user;
    let payOnDelivery = user.pay_on_delivery == 1 ? 'Sim' : 'Não';
    let data = dataTimeBr(user.created_at);
    $('#showModalBody').html(" " +
        "<p><strong>Destino: </strong>" + user.destiny_name + "</p>" +
        "<p><strong>Valor: </strong> R$ " + user.value + "</p>" +
        "<p><strong>Forma de pagamento: </strong>" + user.payment_method_name + "</p>" +
        "<p><strong>Pagamento no destino: </strong>" + payOnDelivery + "</p>" +
        "<p><strong>Criado por: </strong>" + user.client_name + "</p>" +
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
