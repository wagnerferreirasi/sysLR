@section('title', 'Destinos')
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 d-grid d-md-block">
                                <h4 class="mb-0 title fw-bold">Listagem de Destinos</h4>
                            </div>
                            <div class="col-6 d-grid d-md-flex justify-content-md-end">
                                @if(Auth::user()->utype == 'admin')
                                <a href="{{ route('dashboard.destinies.add') }}" class="mb-0 btn btn-sm btn-outline-dark">
                                    <i class="fas fa-map-marked-alt text-warning"></i>
                                    Novo destino
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body" wire:ignore>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tableDestiny">
                                <thead>
                                    <tr>
                                        <th>Destino</th>
                                        <th>Cidade</th>
                                        <th class="text-center">UF</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($destinies as $destiny)
                                    <tr>
                                        <td>{{ $destiny->name }}</td>
                                        <td>{{ $destiny->city }}</td>
                                        <td class="text-center">{{ $destiny->state }}</td>
                                        <td class="text-center">
                                            <button type="button" class="m-0 btn btn-sm btn-outline-dark" title="Visualizar" wire:click="show({{ $destiny->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <a href="{{ route('dashboard.destinies.edit', ['id' => $destiny->id]) }}" class="m-0 btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button type="button" class="m-0 btn btn-sm btn-outline-danger" title="Deletar" wire:click="modalDelete({{ $destiny->id }})">
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
</div>

@section('scripts')
    <script>
        document.addEventListener('showModal', event => {
            $('#showModal').modal('show')
            $('#showModalLabel').html('Destino: <span class="fw-bold">' + event.detail.destinyShow.name + '</span>');
            $('#showModalBody').html('<div class="row"><div class="col-12"><p class="fw-bold">Endereço: <span class="fw-normal">' + event.detail.destinyShow.address + '</span></p></div><div class="col-12"><p class="fw-bold">Cidade: <span class="fw-normal">' + event.detail.destinyShow.city + '</span></p></div><div class="col-12"><p class="fw-bold">UF: <span class="fw-normal">' + event.detail.destinyShow.state + '</span></p></div></div>');

            $('#showModalButtons').html('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>')
        });

        document.addEventListener('modalDelete', event => {
            //abre o modal
            $('#showModal').modal('show')
            $('#showModalLabel').html('Deletar destino: <span class="fw-bold">' + event.detail.destinyDelete.name + '</span>');
            $('#showModalBody').html('<div class="text-center col-12"><span class="fw-bold">Atenção!</span><p class="fw-bold">Tem certeza que deseja deletar este destino?</p><p class="fw-bold text-danger">Esta ação não poderá ser desfeita!</p></div><hr><div class="row"><div class="col-12"><p class="fw-bold">Endereço: <span class="fw-normal">' + event.detail.destinyDelete.address + '</span></p></div><div class="col-12"><p class="fw-bold">Cidade: <span class="fw-normal">' + event.detail.destinyDelete.city + '</span></p></div><div class="col-12"><p class="fw-bold">UF: <span class="fw-normal">' + event.detail.destinyDelete.state + '</span></p></div></div>');

            $('#showModalButtons').html('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button><button type="button" class="btn btn-danger" onclick="Livewire.emit(\'delete\', ' + event.detail.destinyDelete.id + ')">Deletar</button>')
        });

        document.addEventListener('hideModal', event => {
            //fecha o modal
            $('#showModal').modal('hide');
            $('#deleteModal').modal('hide');
        });

        $(document).ready(function() {
            $('#tableDestiny').DataTable({
                drawCallback: function () {
                    $('.page-link').addClass('btn-sm text-dark');
                    $('.page-item.active .page-link').addClass('bg-dark text-white border-dark');
                    $('.dataTables_empty').addClass('lead');
                },
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [3] }
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
    </script>
@endsection
