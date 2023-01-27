@section('title', 'Novo Pacotes')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@endsection

<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h3 class="card-title h3 mt-1 mb-0" wire:ignore>
                            Novo Pacote | <span class="fw-bold">{{ $lrCode }}</span>
                        </h3>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('dashboard.packages') }}"
                                class="btn p-0  m-0 btn-sm btn-secondary float-right btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-arrow-left text-warning"></i>
                                </span>
                                <span class="text">Voltar</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="store">
                            <div class="row" wire:ignore>
                                <div class="col-md-12" >
                                    <div class="form-group">
                                    <label class="bmd-label-floating">Remetente/Fornecedor</label>
                                        <select class="form-select" wire:model="sender" id="selectSenders" required>
                                            <option value="" selected>Selecione um Remetente/Fornecedor</option>
                                            @foreach($senders as $sender)
                                            <option value="{{ $sender->id }}">{{ $sender->cpfcnpj }} - {{ $sender->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('destiny')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row" wire:ignore>
                                <div class="col-md-6">
                                        <label class="bmd-label-floating">Local de destino</label>
                                        <select class="form-select" wire:model="destiny" id="selectDestinies" required>
                                            <option value="" selected>Selecione um ponto de entrega</option>
                                            @foreach($destinies as $destiny)
                                            <option value="{{ $destiny->id }}">{{ $destiny->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('destiny')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6">
                                        <label class="bmd-label-floating">Destinatário/Cliente</label>
                                        <select class="form-select" wire:model="client" id="selectClients" required>
                                            <option value="" selected>Selecione um cliente</option>
                                            @foreach($clients as $client)
                                            <option class="fw-bold" value="{{ $client->id }}">{{ $client->cpfcnpj }} - {{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('client')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <h4 class="text-center fw-bold my-5">
                                    <i class="fas fa-box"></i>
                                    Dados do Pacote
                                </h4>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Comprimento</label>
                                        <input type="text" class="form-control" wire:model.lazy="length">
                                        @error('length')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Largura</label>
                                        <input type="text" class="form-control" wire:model.lazy="width">
                                        @error('width')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Altura</label>
                                        <input type="text" class="form-control" wire:model.lazy="height">
                                        @error('height')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Peso</label>
                                        <input type="text" class="form-control" wire:model.lazy="weight">
                                        @error('weight')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Observação</label>
                                        <textarea class="form-control" wire:model.lazy="observation"
                                            rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-grid px-2">
                                <button type="button" class="btn btn-lg btn-outline-warning" wire:click="loading()">
                                    <i class="fas fa-money-bill"></i>
                                    Ir para Pagamento
                                </button>
                            </div>

                            {{-- modal valor e pagamento --}}
                            <div class="modal fade" id="modalValor" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="modalValor" aria-hidden="true" wire:ignore>
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Valor do frete: <span id="valorPacote"></span></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Valor</label>
                                                        <input type="text" class="form-control" name="value"
                                                            wire:model.lazy="value">
                                                        @error('value')<span
                                                            class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Forma de pagamento</label>
                                                        <select class="form-select" wire:model.lazy="paymentMethod"
                                                            name="paymentMethod" required>
                                                            <option value="" selected>Selecione uma forma de pagamento
                                                            </option>
                                                            <option value="1">Dinheiro</option>
                                                            <option value="2">Cartão de crédito</option>
                                                            <option value="3">Cartão de débito</option>
                                                            <option value="4">Pix</option>
                                                            <option value="5">Transferência bancária</option>
                                                            <option value="6">Boleto</option>
                                                            <option value="0">Pagamento na entrega</option>
                                                        </select>
                                                        @error('payment_method')<span
                                                            class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>

                                            <button type="submit" class="btn btn-primary">
                                                Finalizar pacote
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('value', event => {
            let value = event.detail.value.replace('.', ',');
            $('#valorPacote').html('R$ ' + value);
        });

        document.addEventListener('openModal', event => {
            setTimeout(function() {
                $('#modalValor').modal('show');
            }, 4000);
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#selectSenders').select2({
                theme: "bootstrap4",
                language: {
                    noResults: function () {
                        return "Nenhum resultado encontrado";
                    },
                    searching: function () {
                        return "Buscando...";
                    },
                    inputTooShort: function () {
                        return "Digite pelo menos 3 caracteres";
                    },
                    errorLoading: function () {
                        return "A busca falhou";
                    },
                }
            });
            $('#selectSenders').on('change', function (e) {
                var data = $('#selectSenders').select2("val");
                @this.set('sender', data);
            });

            $('#selectDestinies').select2({
                theme: "bootstrap4",
                language: {
                    noResults: function () {
                        return "Nenhum resultado encontrado";
                    },
                    searching: function () {
                        return "Buscando...";
                    },
                    inputTooShort: function () {
                        return "Digite pelo menos 3 caracteres";
                    },
                    errorLoading: function () {
                        return "A busca falhou";
                    },
                }
            });
            $('#selectDestinies').on('change', function (e) {
                var data = $('#selectDestinies').select2("val");
                @this.set('destiny', data);
            });

            $('#selectClients').select2({
                theme: "bootstrap4",
                language: {
                    noResults: function () {
                        return "Nenhum resultado encontrado";
                    },
                    searching: function () {
                        return "Buscando...";
                    },
                    inputTooShort: function () {
                        return "Digite pelo menos 3 caracteres";
                    },
                    errorLoading: function () {
                        return "A busca falhou";
                    },
                }
            });
            $('#selectClients').on('change', function (e) {
                var data = $('#selectClients').select2("val");
                @this.set('client', data);
            });
        });
    </script>
@endsection
