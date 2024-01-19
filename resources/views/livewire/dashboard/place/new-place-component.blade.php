@section('title', 'Nova Loja')
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h3 class="card-title h3 mt-1 mb-0">
                            Nova Loja
                        </h3>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('dashboard.places') }}"
                                class="btn p-0  m-0 btn-sm btn-secondary float-right btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-arrow-left text-warning"></i>
                                </span>
                                <span class="text">Voltar</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form wire:submit="store">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cnpj">CNPJ</label>
                                        <input type="cnpj" class="form-control" id="cnpj" wire:model="cnpj" placeholder="CNPJ">
                                        @error('cnpj') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input type="text" class="form-control required" id="name" wire:model="name" placeholder="Nome da loja">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="text" class="form-control" id="email" wire:model="email" placeholder="E-mail">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone">Telefone</label>
                                        <input type="text" class="form-control" id="phone" wire:model="phone" placeholder="Telefone">
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="zipcode">Cep</label>
                                        <input type="text" class="form-control" id="zipcode" wire:model.blur="zipcode" placeholder="Cep" wire:change="viaCep()">
                                        @error('zipcode') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">

                                        <label for="address">Endereço</label>
                                        <input type="text" class="form-control" id="address" wire:model="address" placeholder="Endereço">
                                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="number">Número</label>
                                        <input type="text" class="form-control" id="number" wire:model="number" placeholder="Número">
                                        @error('number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="complement">Complemento</label>
                                        <input type="text" class="form-control" id="complement" wire:model="complement" placeholder="Complemento">
                                        @error('complement') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district">Bairro</label>
                                        <input type="text" class="form-control" id="district" wire:model="district" placeholder="Bairro">
                                        @error('district') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="city">Cidade</label>
                                        <input type="text" class="form-control" id="city" wire:model="city" placeholder="Cidade">
                                        @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state">Estado</label>
                                        <input type="text" class="form-control" id="state" wire:model="state" placeholder="Estado">
                                        @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row d-grid px-3">
                                <button type="submit" class="btn btn-lg btn-outline-warning">
                                    <i class="fas fa-save"></i>
                                    Salvar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
