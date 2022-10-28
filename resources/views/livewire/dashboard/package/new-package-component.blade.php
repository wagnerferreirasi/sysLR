@section('title', 'Novo Pacotes')
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
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Remetente</label>
                                        <input type="text" class="form-control" name="name" wire:model.lazy="name">
                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">CPF</label>
                                        <input type="text" class="form-control" name="document"
                                            wire:model.lazy="document">
                                        @error('document')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Celular</label>
                                        <input type="text" class="form-control" name="phone" wire:model.lazy="phone">
                                        @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Email</label>
                                        <input type="text" class="form-control" name="email" wire:model.lazy="email">
                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">

                                        <label class="bmd-label-floating">Local de destino</label>
                                        <select class="form-select" wire:model.lazy="destiny" required>
                                            <option value="" selected>Selecione um ponto de entrega</option>
                                            @foreach($destinies as $destiny)
                                            <option value="{{ $destiny->id }}">{{ $destiny->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('destiny')<span class="text-danger">{{ $message }}</span>@enderror

                                </div>
                                <div class="col-md-6">

                                        <label class="bmd-label-floating">Destinatario/Cliente</label>
                                        <select class="form-select" wire:model.lazy="client" required>
                                            <option value="" selected>Selecione um cliente</option>
                                            @foreach($clients as $client)
                                            <option class="fw-bold" value="{{ $client->id }}">{{ $client->name }}</option>
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
                                        <input type="text" class="form-control" name="length" wire:model.lazy="length">
                                        @error('length')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Largura</label>
                                        <input type="text" class="form-control" name="width" wire:model.lazy="width">
                                        @error('width')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Altura</label>
                                        <input type="text" class="form-control" name="height" wire:model.lazy="height">
                                        @error('height')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Peso</label>
                                        <input type="text" class="form-control" name="weight" wire:model.lazy="weight">
                                        @error('weight')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Observação</label>
                                        <textarea class="form-control" name=observation" wire:model.lazy="observation"
                                            rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-grid px-2">
                                <button type="button" class="btn btn-lg btn-outline-warning" wire:click="calculateValue()" data-bs-toggle="modal" data-bs-target="#modalValor">
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
                                            <h5 class="modal-title" id="modalValor">Valor do frete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Valor</label>
                                                        <input type="text" class="form-control" name="value"
                                                            wire:model="value">
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
