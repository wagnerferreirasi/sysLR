@section('title', 'Dashboard')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="row">
                    <div class="col-12">
                        <h3 class="panel-title mb-5 fw-bold">Dashboard</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title mb-0">Clientes cadastrados por dia</h3>
                                    </div>
                                    <div class="card-body">
                                        {!! $chartClients->render() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title mb-0">Rotas cadastrados por dia</h3>
                                    </div>
                                    <div class="card-body">
                                        {!! $chartRoutes->render() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title mb-0">Pacotes por loja</h3>
                                    </div>
                                    <div class="card-body">
                                        {!! $chartPackages->render() !!}
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
