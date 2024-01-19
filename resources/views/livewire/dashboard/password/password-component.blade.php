@section('title', 'Password')
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 d-grid d-md-block">
                                <h5 class="mb-0 title fw-bold">Senhas Administrativas</h5>
                            </div>
                            <div class="col-6 d-grid d-md-flex justify-content-md-end">
                                @if(Auth::user()->can('master'))
                                    <button wire:click="forcePassword()" class="mb-0 btn btn-sm btn-outline-dark">
                                        <i class="fas fa-sync text-warning"></i>&nbsp;
                                        Gerar nova senha
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            @if(Auth::user()->can('master'))
                            <p>
                                Sua senha é:
                            </p>

                            <span wire:loading>Gerando...</span>
                            <h1 class="text-7xl font-bold text-amber-400">
                                {{ $pwd->password ?? 'Senha Expirada! Atualize a página.' }}
                            </h1>
                            <p>
                                <small>
                                    <i class="fas fa-info-circle text-red-500"></i>&nbsp;
                                    Esta senha é válida por 3 minutos.
                                    <br>
                                    @if(isset($pwd->created_at))
                                        <i class="m-0">Hora de expiração: {{ date('H:i', strtotime($pwd->expiration_date)) }}</i>
                                    @endif
                                </small>
                            </p>
                            @else
                                <p>
                                    Você não tem permissão para visualizar esta página.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
