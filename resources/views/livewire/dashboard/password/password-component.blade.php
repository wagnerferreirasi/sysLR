@section('title', 'Password')
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 d-grid d-md-block">
                                <h5 class="title fw-bold mb-0">Senhas Administrativas</h5>
                            </div>
                            <div class="col-6 d-grid d-md-flex justify-content-md-end">
                                @if(Auth::user()->utype == 'admin')
                                    <button wire:click="forcePassword()" class="btn btn-sm btn-outline-dark mb-0">
                                        <i class="fas fa-sync text-warning"></i>&nbsp;
                                        Gerar nova senha
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <p>
                                Sua senha é:
                            </p>
                            <h1>
                                {{ $pwd ?? 'Access Denied' }}
                            </h1>
                            <p>
                                <small>
                                    <i class="fas fa-info-circle text-yellow"></i>&nbsp;
                                    Esta senha é válida por 3 minutos.
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
