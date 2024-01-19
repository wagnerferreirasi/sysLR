@section('title', 'Editar Destino')
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h3 class="card-title h3 mt-1 mb-0">
                            Editar Destino
                        </h3>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('dashboard.destinies') }}"
                                class="btn p-0  m-0 btn-sm btn-secondary float-right btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-arrow-left text-warning"></i>
                                </span>
                                <span class="text">Voltar</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form wire:submit="update">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input type="text" class="form-control required" id="name"
                                            wire:model="name" placeholder="Nome do destino">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Telefone</label>
                                        <input type="text" class="form-control" id="phone" wire:model.blur="phone"
                                            placeholder="Telefone">
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Endereço</label>
                                        <input type="text" class="form-control" id="address" wire:model.blur="address"
                                            placeholder="Endereço">
                                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">Cidade</label>
                                        <input type="text" class="form-control" id="city" wire:model.blur="city"
                                            placeholder="Cidade">
                                        @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state">Estado</label>
                                        <input type="text" class="form-control" id="state" wire:model.blur="state"
                                            placeholder="Estado">
                                        @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-outline-warning btn-block">
                                            <i class="fas fa-save"></i>
                                            Editar
                                        </button>
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
