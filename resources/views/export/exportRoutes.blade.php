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
        Listagem de Rotas
    </h1>
</div>
<div class="table-wrapper">
    <table class="fl-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Origem</th>
                <th>Destino</th>
                <th>Valor 1</th>
                <th>Valor 2</th>
                <th>Valor 3</th>
            </tr>
        </thead>
        <tbody>
            @foreach($routes as $route)
            <tr>
                <td>{{ $route->id }}</td>
                <td>{{ $route->place_name }}</td>
                <td>{{ $route->destiny_name }}</td>
                <td>{{ $route->price1 }}</td>
                <td>{{ $route->price2 }}</td>
                <td>{{ $route->price3 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
