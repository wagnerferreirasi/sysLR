@section('title', 'Caixa')
<div>
    <div class="container-fluid">
        <div class="row">
            <!--  -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0 title">
                            Op.: <strong>{{ Auth::user()->name }}</strong>
                        </h4>
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body" wire:ignore>
                        @if($cashier)
                            @if ($cashier->status == 'open')
                                <p>Aberto em: {{ date('d/m/Y', strtotime($cashier->created_at)) }}</p>
                                <p class="font-weight-bold">- Total em Caixa: R${{ $amount ?? 0 }} </p>

                                <a href="#" class="mb-2 btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalFecharCaixa">
                                    <i class="bi bi-cash"></i>
                                    Fechar Caixa
                                </a>
                                <button type="button" class="mb-2 btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalRetirada">
                                    <i class="bi bi-cash"></i>
                                    Retirada
                                </button>
                            @else
                                <a href="#" class="mb-2 btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalAbrirCaixa">
                                    <i class="bi bi-cash"></i>
                                    Abrir Caixa
                                </a>

                                <p>Fechado em: {{ date('d/m/Y', strtotime($cashier->updated_at)) }}</p>
                            @endif
                        @else
                            <p class="category">Nenhum caixa aberto para este usuário, necessário abrir um caixa para realizar movimentações.</p>
                            <a href="#" class="mb-2 btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalAbrirCaixa">
                                <i class="bi bi-cash"></i>
                                Abrir Caixa
                            </a>
                            <br>
                        @endif
                        <p class="mt-5 mb-0 lead font-weight-bold">Lista de movimentações</p>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="dataMovimento" style="width: 100%;">
                                <thead>
                                    <th>#</th>
                                    <th>Data/Hora</th>
                                    <th>Tipo</th>
                                    <th>Valor</th>
                                    <th>Forma Pagto</th>
                                    <th>Descrição</th>
                                </thead>
                                <tbody>
                                @if ($movements)
                                    @foreach($movements as $movement)
                                    <tr>
                                        <td>{{ $movement->id }}</td>
                                        <td>{{ date('d/m/Y H:i:s', strtotime($movement->created_at)) }}</td>
                                        <td>{{ $movement->type }}</td>
                                        <td>{{ $movement->value }}</td>
                                        <td>{{ $movement->paymentMethod->name }}</td>
                                        <td>{{ $movement->description }}</td>
                                    </tr>
                                    @endforeach
                                @endif
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

    <div class="modal fade" id="modalAbrirCaixa" tabindex="-1" role="dialog" aria-labelledby="modalAbrirCaixa" aria-hidden="true" data-bs-backdrop="static" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAbrirCaixa">Abrir Caixa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="openCashier" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="value">Valor</label>
                            <input type="text" class="form-control" name="value"  wire:model="state.value" placeholder="Valor" required>
                            @error('value')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <input type="text" class="form-control" name="description" wire:model="state.description" placeholder="Descrição" required>
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="payment_method">Forma de Pagamento</label>
                            <select name="payment_method" wire:model="state.paymentMethod" class="form-select" required>
                                <option value="">Selecione</option>
                                <option value="1">Dinheiro</option>
                            </select>
                            @error('paymentMethod')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="type">Tipo</label>
                            <select name="type" wire:model="state.type" class="form-select" required>
                                <option value="">Selecione</option>
                                <option value="in">Entrada</option>
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-dark">Abrir Caixa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal fechar caixa -->
    <div class="modal fade" id="modalFecharCaixa" tabindex="-1" role="dialog" aria-labelledby="modalFecharCaixa" aria-hidden="true" data-bs-backdrop="static" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFecharCaixa">Fechar Caixa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="lead">Deseja realmente fechar o caixa?</p>
                    <div class="d-grid">
                        <button type="button" class="btn btn-outline-dark" wire:click="closeCashier">Fechar Caixa</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- modal senha retirada -->
    <div class="modal fade" id="modalRetirada" tabindex="-1" role="dialog" aria-labelledby="modalRetirada" aria-hidden="true" data-bs-backdrop="static" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRetirada">Fazer Retirada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="withdrawal" method="post" autocomplete="off">
                        @csrf
                        @method('POST')
                        <p class="lead">Deseja realmente fazer uma retirada?</p>
                        <div class="form-group">
                            <label for="value">Valor</label>
                            <input type="text" class="form-control" name="value"  wire:model="state.value" placeholder="Valor" required>
                            @error('value')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Senha Administrativa</label>
                            <input type="password" class="form-control" name="password" wire:model="password" placeholder="Senha" required>
                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-dark">
                                Fazer Retirada
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal valor retirada -->
    <div class="modal fade" id="modalValorRetirada" tabindex="-1" role="dialog" aria-labelledby="modalValorRetirada" aria-hidden="true" data-bs-backdrop="static" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalValorRetirada">Fazer Retirada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataMovimento').DataTable({
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
