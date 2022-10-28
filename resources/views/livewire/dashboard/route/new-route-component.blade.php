@section('title', 'Nova Rota')
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h3 class="card-title h3 mt-1 mb-0">
                            Nova Rota
                        </h3>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('dashboard.routes') }}"
                                class="btn p-0  m-0 btn-sm btn-secondary float-right btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-arrow-left text-warning"></i>
                                </span>
                                <span class="text">Voltar</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="storeRoute">
                            @if(Auth::user()->utype == 'admin' || Auth::user()->utype == 'master')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Origem</label>
                                        <select wire:model="place_id" class="form-select">
                                            <option value="" selected>Selecione a origem</option>
                                            @foreach($places as $place)
                                            <option value="{{ $place->id }}">{{ $place->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('place_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Destino</label>
                                        <select wire:model.defer="destiny_id" class="form-select">
                                            <option value="" selected>Selecione um destino</option>
                                            @foreach($destinies as $destiny)
                                            <option value="{{ $destiny->id }}">{{ $destiny->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('destiny_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Valor 1</label>
                                        <input wire:model.defer="price1" type="text" class="form-control">
                                        @error('price1') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Valor 2</label>
                                        <input wire:model.defer="price2" type="text" class="form-control">
                                        @error('price2') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Valor 3</label>
                                        <input wire:model.defer="price3" type="text" class="form-control">
                                        @error('price3') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Status</label>
                                        <select wire:model.defer="status" class="form-select">
                                            <option value="">Selecione um status</option>
                                            <option value="1">Ativo</option>
                                            <option value="0">Inativo</option>
                                        </select>
                                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Salvar</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

