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
                                <div class="card mb-5 shadow-sm border-0 roumded-lg">
                                    <div class="card-header">
                                        <h4 class="m-0">Filtros de relatório</h4>
                                    </div>
                                    <div class="card-body border-0 bg-light">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="place" class="form-label">Loja</label>
                                                    <select class="form-select" id="place">
                                                        <option value="">Selecione</option>
                                                        <option value="all">Todas</option>
                                                        @foreach ($places as $place)
                                                        <option value="{{ $place->id }}">{{ $place->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="dateStart" class="form-label">Data Inicial</label>
                                                    <input type="date" class="form-control" id="dateStart">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="dateEnd" class="form-label">Data Final</label>
                                                    <input type="date" class="form-control" id="dateEnd">
                                                </div>
                                            </div>
                                            <div class="col-md-3 pt-2 text-sm">
                                                <button type="button" id="updateTable"
                                                    class="btn btn-primary mt-4 mr-2">
                                                    <i class="fas fa-filter"></i>
                                                    Filtrar
                                                </button>
                                                <a id="exportData" class="btn btn-success mt-4"
                                                    href="{{ route('dashboard.reports.cashiers.export') }}">
                                                    <i class="fas fa-file-excel"></i>
                                                    Exportar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
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
                                        <tbody id="dataReportCashiers"></tbody>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script>
$(document).ready(() => {
    const getFilters = () => {
        return {
            placeId: $('#place').val(),
            dateStart: $('#dateStart').val(),
            dateEnd: $('#dateEnd').val(),
        }
    }

    $('#exportData').on('click', () => {
        const filters = getFilters();
        const url = $('#exportData').attr('href');

        $('#exportData').attr('href',
            `${url}?placeId=${filters.placeId}&dateStart=${filters.dateStart}&dateEnd=${filters.dateEnd}`
        );
    });

    datatable = $('#cachierReport').DataTable({
        responsive: true,
        serverSide: true,
        dom: 'rtip',
        pagingType: 'full_numbers',
        pageLength: 10,
        "order": [],
        ajax: {
            url: "{{ route('dashboard.reports.cashiers.getData') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            data: function(d) {
                return $.extend({}, d, getFilter());
            }
        },
        "oLanguage": {
            "sProcessing": "Processando...",
            "sLengthMenu": "Mostrando _MENU_ registros por página",
            "sZeroRecords": "Nenhum registro encontrado",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 de 0 de 0 registros",
            "oPaginate": {
                "sNext": "Próxima",
                "sFirst": "Primeira",
                "sLast": "Ultima",
                "sPrevious": "Anterior"
            },
            "sSearch": "Buscar:",
            "sInfoFiltered": ""
        },
        columnDefs: [{
                "render": function(data, type, row) {
                    return row.userName;
                },
                "targets": 0
            },
            {
                "render": function(data, type, row) {
                    return row.placeName;
                },
                "targets": 1
            },
            {
                "render": function(data, type, row) {
                    return `R$ ${parseFloat(row.value).toFixed(2).replace('.', ',')}`;
                },
                "targets": 2
            },
            {
                "render": function(data, type, row) {
                    return moment(row.created_at).format('DD/MM/YYYY HH:mm:ss');
                },
                "targets": 3
            },
        ]
    });


    $('#updateTable').click(function() {
        datatable.draw();
    });

});
</script>
@endsection
