<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 d-grid d-md-block">
                                <h4 class="title fw-bold mb-0">Relatórios</h4>
                            </div>

                        </div>
                    </div>
                    <div class="card-body" wire:ignore>
                        <div class="row my-5">
                            <div class="col-4">
                                <a href="{{ route('dashboard.reports.cashiers') }}">
                                    <div class="card text-white bg-primary mb-3">
                                        <div class="card-header text-bold h4 text-center">
                                            <i class="fas fa-cash-register nav-icon "></i> Caixa
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">
                                                Resumo de vendas e recebimentos de todos os caixas por período e
                                                operador.
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-4">
                                <div class="card text-white bg-primary mb-3">
                                    <div class="card-header text-bold h4 text-center">
                                        <i class="fas fa-box nav-icon"></i> Pacote
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            Resumo de pacotes enviados e recebimentos por período e operador.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card text-white bg-primary mb-3">
                                    <div class="card-header text-bold h4 text-center">
                                        <i class="fas fa-route nav-icon"></i> Rota
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            Resumo de rotas por período, operador e quantidade de pacotes.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
