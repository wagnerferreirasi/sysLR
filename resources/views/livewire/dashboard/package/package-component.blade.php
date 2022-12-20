@section('title', 'Pacotes')
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 d-grid d-md-block">
                                <h4 class="title fw-bold mb-0">Listagem de Pacotes</h4>
                            </div>
                            <div class="col-6 d-grid d-md-flex justify-content-md-end">
                                @if(Auth::user()->utype == 'admin')
                                <a href="{{ route('dashboard.packages.add') }}" class="btn btn-sm btn-outline-dark mb-0">
                                    <i class="fas fa-box text-warning"></i>&nbsp;
                                    Novo pacotes
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                            <a href="" class="btn btn-sm btn-outline-dark m-0" title="Vizualizar">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="" class="btn btn-sm btn-outline-warning m-0" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm m-0" title="Deletar">
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
</div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#tablePlace').DataTable({
                drawCallback: function () {
                    $('.page-link').addClass('btn-sm text-dark');
                    $('.page-item.active .page-link').addClass('bg-dark text-white border-dark');
                    $('.dataTables_empty').addClass('lead');
                },
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
    </script>
@endsection
