<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes - Mini CRM</title>
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
        <a href="/oportunidades">Ir a Oportunidades</a>
    </div>

    <h1>Crear Cliente</h1>
    <form id="formulario_cliente">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="telefono" placeholder="Teléfono">
        <input type="text" name="empresa" placeholder="Empresa">
        <button type="submit">Crear Cliente</button>
    </form>

    <hr>

    <button id="mostrar-clientes">Mostrar Todos los Clientes</button>

    <h2>Listado de Clientes</h2>
    <table id="clientes-tabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Empreda</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script src="{{ asset('js/clientes.js') }}"></script>
</body>
</html>
