const apiBase = '/api';

//rear cliente 
document.getElementById('formulario_cliente').addEventListener('submit', async e => {
    e.preventDefault();
    const form = e.target;

    const email = form.email.value;

    try {
        //obtener todos los clientes
        const listRes = await fetch(`${apiBase}/clientes`);
        const clientes = await listRes.json();

        //comprobar si el email ya existe
        const emailExists = clientes.some(c => c.email === email);
        if (emailExists) {
            alert('El correo ya está existe, prueba con otro crak');
            return; // salir, no crear cliente
        }

        //crear cliente si no existe
        const data = {
            nombre: form.nombre.value,
            email,
            telefono: form.telefono.value,
            empresa: form.empresa.value
        };
        //inyecto la orden
        const res = await fetch(`${apiBase}/clientes`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        //controlar si se ha creado, si no tener constacia de que error ha sido
        if (res.ok) {
            alert('Cliente creado correctamente');
            form.reset();
        } else {
            const error = await res.json();
            alert('Error: ' + JSON.stringify(error));
        }

    } catch (err) {
        alert('Error de conexión: ' + err.message);
    }
});


//mostrar clientes en tabla
document.getElementById('mostrar-clientes').addEventListener('click', async () => {
    try {
        const res = await fetch(`${apiBase}/clientes`);
        const clientes = await res.json();

        const tbody = document.querySelector('#clientes-tabla tbody');
        tbody.innerHTML = '';

        clientes.forEach(c => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${c.id}</td>
                <td>${c.nombre}</td>
                <td>${c.email}</td>
                <td>${c.telefono || ''}</td>
                <td>${c.empresa || ''}</td>
            `;
            tbody.appendChild(tr);
        });
    } catch (err) {
        alert('Error al cargar clientes: ' + err.message);
    }
});
