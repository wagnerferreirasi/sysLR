@section('title', 'Rotas')
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 d-grid d-md-block">
                                <h4 class="title fw-bold mb-0">Listagem de Rotas</h4>
                            </div>
                            <div class="col-6 d-grid d-md-flex justify-content-md-end">
                                @if(Auth::user()->utype == 'admin')
                                <a href="{{ route('dashboard.routes.add') }}" class="btn btn-sm btn-outline-dark mb-0">
                                    <i class="fas fa-route text-warning"></i>&nbsp;
                                    Nova rota
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
                                        <th>Origem</th>
                                        <th>Destino</th>
                                        <th>Valor 1</th>
                                        <th>Valor 2</th>
                                        <th>Valor 3</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($routes as $route)
                                    <tr>
                                        <td>{{ $route->place_name }}</td>
                                        <td>{{ $route->destiny_name }}</td>
                                        <td>R$ {{ str_replace('.', ',', $route->price1) }}</td>
                                        <td>R$ {{ str_replace('.', ',', $route->price2) }}</td>
                                        <td>R$ {{ str_replace('.', ',', $route->price3) }}</td>
                                        <td class="text-center">
                                            @if($route->status == '1')
                                            <span class="badge bg-success">Ativo</span>
                                            @else
                                            <span class="badge bg-danger">Inativo</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <!-- <a href="" class="btn btn-sm btn-outline-dark m-0" title="Vizualizar">
                                                <i class="fas fa-eye"></i>
                                            </a> -->
                                            <a href="{{ route('dashboard.routes.edit', [$route->id])}}" class="btn btn-sm btn-outline-warning m-0" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm m-0" title="Deletar" wire:click="delete({{ $route->id }})">
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
            $('#tableDestiny').DataTable({
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
    </script>
@endsection
