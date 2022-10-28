<style>
* {
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
}

body {
    font-family: Helvetica;
    -webkit-font-smoothing: antialiased;
}

h2 {
    text-align: center;
    font-size: 18px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: white;
    padding: 30px 0;
}

/* Table Styles */

.table-wrapper {
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.2);
}

.fl-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.fl-table td,
.fl-table th {
    text-align: center;
    padding: 8px;
}

.fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 12px;
}

.fl-table thead th {
    color: #ffffff;
    background: #FFDD40;
}


.fl-table thead th:nth-child(odd) {
    color: #ffffff;
    background: #343A40;
}

.fl-table tr:nth-child(even) {
    background: #F8F8F8;
}
</style>
<div>
    <h1 style="text-align: center;">
        Movimentações de caixa
    </h1>
    <small style="text-align: center;">
        Operador: {{ Auth::user()->name }}
    </small>
</div>
<table>
    <thead>
        <th>#</th>
        <th>Data/Hora</th>
        <th>Tipo</th>
        <th>Valor</th>
        <th>Forma Pagto</th>
        <th>Descrição</th>
    </thead>
    <tbody>
        @foreach($movements as $movement)
        <tr>
            <td>{{ $movement->id }}</td>
            <td>{{ date('d/m/Y H:i:s', strtotime($movement->created_at)) }}</td>
            <td>{{ $movement->type }}</td>
            <td>{{ $movement->value }}</td>
            <td>{{ $movement->paymentMethod->name }}</td>
            <td>{{ $movement->description }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
