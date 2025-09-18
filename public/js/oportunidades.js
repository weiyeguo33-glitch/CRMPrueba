//usar una constante par que quede mas limpio, en proyectos pequenitos como este no creo que sea necesario pero queda bonito
const apiBase = '/api';

//la funcion que carga clientes existentes para el desplegable del formulariom, para que la gente no meta clientes inexistentes y me de un cacho error
async function cargarClientes() {
    const select = document.getElementById('cliente_id');
    try {
        //accede a la api clientes para recuperar todos los cleintes
        const res = await fetch(`${apiBase}/clientes`);
        //transformacion!!!
        const clientes = await res.json();


        select.innerHTML = ''; 

        //por cada cliente encontrado creamos una fila con valor su id y con el texto del email ya que es el campo que no se puede repetir, se podria porner nombre tambien, como guste
        clientes.forEach(c => {
            const option = document.createElement('option');
            option.value = c.id;
            option.textContent = `${c.email}`;
            select.appendChild(option);
        });
    } catch (err) {
        select.innerHTML = '<option value="">Error al cargar clientes</option>';
        alert('Error al cargar clientes: ' + err.message);
    }
}

//crear oportunidad
//al aprietar el boton del html ejecuta esta funcion
document.getElementById('formulario_oportunidad').addEventListener('submit', async e => {
    e.preventDefault();
    const form = e.target;
        //recupera informacion del formulario
        const data = {
            titulo: form.titulo.value,
            monto_estimado: parseFloat(form.monto_estimado.value),
            estado: form.estado.value,
            cliente_id: parseInt(form.cliente_id.value)
        };
        
  

        //metemos el post en un try para controlar errores
    try {
        const res = await fetch(`${apiBase}/oportunidades`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        //si devuelve que se ha creado correctamente se lo mostramos al ususario
        if (res.ok) {
            alert('Oportunidad creada correctamente');
            
            form.reset();
        } else {//si no pues el error que ha surgido
            const error = await res.json();
            alert('Error al crear oportunidad: ' + JSON.stringify(error));
        }
    } catch (err) {
        alert('Error de conexión: ' + err.message);
    }
});

//mostrar todas las oportunidades
document.getElementById('mostrar-oportunidades').addEventListener('click', async () => {
    try {
        //acceso a la api de oportunidades
        const res = await fetch(`${apiBase}/oportunidades`);
        const oportunidades = await res.json();

        const tbody = document.querySelector('#oportunidades-tabla tbody');
        tbody.innerHTML = '';

        //igual que arrba donde buscamos clientes, aqui mostramos toda la informacion, por cada oportunidad una fila y por cada elemento una columna
        oportunidades.forEach(o => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${o.id}</td>
                <td>${o.titulo}</td>
                <td>${o.monto_estimado}</td>
                <td>${o.estado}</td>
                <td>${o.cliente_id}</td>
            `;
            tbody.appendChild(tr);
        });
    } catch (err) {
        alert('Error al cargar oportunidades: ' + err.message);
    }
});

  //abre el json en pestaña nueva
  document.getElementById('export-json').addEventListener('click', () => {
    window.open(`${apiBase}/oportunidades/export?format=json`, '_blank');
});

//boton ccs con el endpoint que llama a la api y esata acceda a la funcion del controlador
document.getElementById('export-csv').addEventListener('click', () => {
    window.location.href = `${apiBase}/oportunidades/export?format=csv`;
});

//para cargar los clientes del desplegable al entrar en la pagina
cargarClientes();


