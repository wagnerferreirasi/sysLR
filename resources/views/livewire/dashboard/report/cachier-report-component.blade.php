@section('title', 'Relatórios de Caixa')
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Relatórios Movimento de Caixa</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-5 shadow-sm border-0">
                                    <form id="form-filters">
                                        <div class="card-header">
                                            <h4 class="m-0">Filtros de relatório</h4>
                                        </div>
                                        <div class="card-body border-0">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="place" class="form-label">Loja</label>
                                                        <select class="form-select" id="place" wire:model="place">
                                                            <option value="">Selecione</option>
                                                            @foreach ($places as $place)
                                                            <option value="{{ $place->id }}">{{ $place->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="dateStart" class="form-label">Data Inicial</label>
                                                        <input type="date" class="form-control" id="dateStart"
                                                            wire:model="dateStart">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="dateEnd" class="form-label">Data Final</label>
                                                        <input type="date" class="form-control" id="dateEnd"
                                                            wire:model="dateEnd">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pt-2">
                                                    <button type="submit" class="btn btn-block btn-primary mt-4">
                                                        <i class="fas fa-filter"></i>
                                                        Filtrar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="cachierReport" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Loja</th>
                                                <th>Valor</th>
                                                <th>Data</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cashierReports as $cashierReport)
                                            <tr>
                                                <td>{{ $cashierReport->userName }}</td>
                                                <td>{{ $cashierReport->placeName }}</td>
                                                <td>R${{ str_replace('.', ',', $cashierReport->value) }}</td>
                                                <td>{{ date('d/m/Y H:i:s', strtotime($cashierReport->date)) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
$(document).ready(function() {
    $('#cachierReport').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nenhum registro encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(filtrado de _MAX_ registros no total)",
            "search": "Pesquisar",
            "paginate": {
                "previous": "Anterior",
                "next": "Próximo"
            }
        }
    });
});
</script>
@endsection
