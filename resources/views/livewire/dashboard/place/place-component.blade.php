@section('title', 'Lojas')
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 d-grid d-md-block">
                                <h4 class="mb-0 title fw-bold">Listagem de Lojas</h4>
                            </div>
                            <div class="col-6 d-grid d-md-flex justify-content-md-end">
                                @if(Auth::user()->utype == 'admin')
                                <a href="{{ route('dashboard.places.add') }}" class="mb-0 btn btn-sm btn-outline-dark">
                                    <i class="fas fa-store text-warning"></i>&nbsp;
                                    Nova Loja
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body" wire:ignore>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tablePlace">
                                <thead>
                                    <tr>
                                        <th>Loja</th>
                                        <th>Telefone</th>
                                        <th>Endereço</th>
                                        <th>Cidade</th>
                                        <th>Estado</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($places as $place)
                                    <tr>
                                        <td>{{ $place->name }}</td>
                                        <td>{{ $place->phone }}</td>
                                        <td>{{ $place->address }}</td>
                                        <td>{{ $place->city }}</td>
                                        <td>{{ $place->state }}</td>
                                        <td>
                                            @if (Auth::user()->can('place_full_access') || Auth::user()->can('place_view'))
                                                <button type="button" class="m-0 btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#showPlaceModal{{$place->id}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            @endif
                                            @if (Auth::user()->can('place_full_access') || Auth::user()->can('place_edit'))
                                                <a href="{{ route('dashboard.places.edit', ['id' => $place->id])}}" class="m-0 btn btn-sm btn-outline-warning" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif
                                            @if (Auth::user()->can('place_full_access') || Auth::user()->can('place_delete'))
                                                <button type="button" class="m-0 btn btn-outline-danger btn-sm" title="Deletar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- modal show place -->
                                    <div class="modal fade" id="showPlaceModal{{$place->id}}" tabindex="-1" aria-labelledby="showPlaceModalLabel" aria-hidden="true" wire:ignore>
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="showPlaceModalLabel">Vizualizar Loja - <span class="text-warning">{{$place->name}}</span></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="name">Nome</label>
                                                                <input type="text" class="form-control" id="name" name="name" value="{{ $place->name }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="cnpj">CNPJ</label>
                                                                <input type="text" class="form-control" id="cnpj" name="cnpj" value="{{ $place->cnpj }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="phone">Telefone</label>
                                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $place->phone }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="email">E-mail</label>
                                                                <input type="text" class="form-control" id="email" name="email" value="{{ $place->email }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="address">Endereço</label>
                                                                <input type="text" class="form-control" id="address" name="address" value="{{ $place->address }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="city">Cidade</label>
                                                                <input type="text" class="form-control" id="city" name="city" value="{{ $place->city }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="state">Estado</label>
                                                                <input type="text" class="form-control" id="state" name="state" value="{{ $place->state }}" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end modal show place -->
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
