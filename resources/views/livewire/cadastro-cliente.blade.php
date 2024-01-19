@section('title', 'Novo Cliente/Fornecedor')
<div>
    {{-- banner header --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-4 bg-black text-center">
                <img src="{{ asset('assets/img/logoalpha_branco.png') }}" alt="Banner LRTUR TRANSLOG" class="img-fluid my-4" width="120">
                <h1 class="text-white uppercase">
                    Cadastro de Clientes e Fornecedores
                </h1>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header card-header-primary bg-warning">
                        <h3 class="card-title h3 mt-1 mb-0">
                            Novo Cliente/Fornecedor
                        </h3>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="store">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <label for="type">Tipo</label>
                                        <select class="form-select" id="type" wire:model.defer="type">
                                            <option>Selecione</option>
                                            <option value="Client">Cliente</option>
                                            <option value="Company">Fornecedor</option>
                                        </select>
                                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cpfcnpj">CPF/CNPJ</label>
                                        <input type="text" class="form-control required" id="cpfcnpj" wire:model.defer="cpfcnpj" placeholder="Cpf/Cnpj">
                                        @error('cpfcnpj') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input type="text" class="form-control" id="name"
                                            wire:model.defer="name" placeholder="Nome">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="rg">RG</label>
                                        <input type="text" class="form-control" id="rg" wire:model.defer="rg"
                                            placeholder="RG">
                                        @error('rg') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">E-Mail</label>
                                        <input type="email" class="form-control" id="email"
                                            wire:model.defer="email" placeholder="E-Mail">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Telefone</label>
                                        <input type="text" class="form-control" id="phone"
                                            wire:model.defer="phone" placeholder="Telefone">
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="zip_code">Cep</label>
                                        <input type="text" class="form-control" id="zip_code"
                                            wire:model.lazy="zip_code" placeholder="Cep" wire:change="viaCep()">
                                        @error('zip_code') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="address">Endereço</label>
                                        <input type="text" class="form-control" id="address"
                                            wire:model.defer="address" placeholder="Endereço">
                                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="number">Número</label>
                                        <input type="text" class="form-control" id="number"
                                            wire:model.defer="number" placeholder="Número">
                                        @error('number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="complement">Complemento</label>
                                        <input type="text" class="form-control" id="complement"
                                            wire:model.defer="complement" placeholder="Complemento">
                                        @error('complement') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district">Bairro</label>
                                        <input type="text" class="form-control" id="district"
                                            wire:model.defer="district" placeholder="Bairro">
                                        @error('district') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="city">Cidade</label>
                                        <input type="text" class="form-control" id="city"
                                            wire:model.defer="city" placeholder="Cidade">
                                        @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state">Estado</label>
                                        <input type="text" class="form-control" id="state"
                                            wire:model.defer="state" placeholder="Estado">
                                        @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row d-grid px-3 mt-4">
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
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#rg').mask('00.000.000-0', {reverse: true});
            $('#phone').mask('(00) 00000-0000');
            $('#zip_code').mask('00000-000');
        });
    </script>
@endsection

