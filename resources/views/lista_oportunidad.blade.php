<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Oportunidades - Mini CRM</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 7px;
        }
    </style>
</head>
<body>

<div class="link-derecha">
        <a href="/clientes">Ir a clientes</a>
    </div>
    <h1>Crear Oportunidad</h1>
    <form id="formulario_oportunidad">
        <input type="text" name="titulo" placeholder="Título" required>
        <input type="number" name="monto_estimado" placeholder="Monto estimado" required>
        
        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="Nueva">Nueva</option>
            <option value="En proceso">En proceso</option>
            <option value="Cerrada">Cerrada</option>
        </select>

        <label for="cliente_id">Cliente:</label>
        <select name="cliente_id" id="cliente_id" required>
            <option value="">Cargando clientes...</option>
        </select>

        <button type="submit">Crear Oportunidad</button>
    </form>

    <hr>

    <button id="mostrar-oportunidades">Mostrar Todas las Oportunidades</button>

    <h2>Listado de Oportunidades</h2>
    <table id="oportunidades-tabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Monto</th>
                <th>Estado</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <div class="export-buttons">
        <button id="export-json">Exportar JSON</button>
        <button id="export-csv">Exportar CSV</button>
    </div>

    <script src="{{ asset('js/oportunidades.js') }}"></script>
</body>
</html>
