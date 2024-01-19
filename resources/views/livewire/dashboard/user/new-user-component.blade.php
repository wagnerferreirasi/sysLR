@section('title', 'Novo Usuário')
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h3 class="mt-1 mb-0 card-title h3">
                            Novo Usuário
                        </h3>
                        <div class="gap-2 d-grid d-md-flex justify-content-md-end">
                            <a href="{{ route('dashboard.users') }}"
                                class="float-right p-0 m-0 btn btn-sm btn-secondary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-arrow-left text-warning"></i>
                                </span>
                                <span class="text">Voltar</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form wire:submit.prevent="store">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Nome</label>
                                        <input type="text" class="form-control" wire:model.defer="name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Login</label>
                                        <input type="text" class="form-control" wire:model.defer="login">
                                        @error('login')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="email" class="form-control" wire:model.defer="email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Tipo de Acesso</label>
                                        <select class="form-select" wire:model.defer="utype">
                                            <option value="">Selecione</option>
                                            <option value="admin">Administrador</option>
                                            <option value="manager">Gerente</option>
                                            <option value="user">Usuário</option>
                                        </select>
                                        @error('utype')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Senha</label>
                                        <input type="password" class="form-control" wire:model.defer="password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Confirme a Senha</label>
                                        <input type="password" class="form-control" wire:model.defer="password_confirmation">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="px-3 row d-grid">
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
@endsection
