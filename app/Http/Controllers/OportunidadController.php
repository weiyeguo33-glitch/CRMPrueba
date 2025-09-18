<?php

namespace App\Http\Controllers;

use App\Models\Oportunidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OportunidadController extends Controller
{
    //listar las oportunidades
    public function index()
    {
        return response()->json(Oportunidad::with('cliente')->get());
    }

    //crear una oportunidad
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'titulo' => 'required|string|max:255',
            'monto_estimado' => 'required|numeric|min:0',
            'estado' => 'required|in:Nueva,En proceso,Cerrada',
        ]);

        $oportunidad = Oportunidad::create($request->all());
        return response()->json($oportunidad, 201);
    }



    //exportar oportunidades a CSV o JSON
    public function export(Request $request)
    {
        $format = $request->query('format', 'csv'); 
        $oportunidades = Oportunidad::with('cliente')->get();

        //si es json devolvemos el json
        if ($format === 'json') {
            return response()->json($oportunidades);
        }

        //generar CSV
        $datosCSV = [];
        //primera fila que son los campos que existen
        $datosCSV[] = ['ID', 'Cliente', 'Email', 'Titulo', 'Monto Estimado', 'Estado', 'Creado', 'Actualizado'];

        //recorrer con un foreach y rellenar
        foreach ($oportunidades as $o) {
            $datosCSV[] = [
                $o->id,
                $o->cliente->nombre,
                $o->cliente->email,
                $o->titulo,
                $o->monto_estimado,
                $o->estado,
                $o->created_at,
                $o->updated_at,
            ];
        }

        //el nombre del archivo
        $nombrearchivo = 'unaoportunidadporfa.csv';
        //memoria temporal para escribir en ella
        $memoria = fopen('php://memory', 'w');
        //rellenar el csv de la memoria
        foreach ($datosCSV as $row) {
            fputcsv($memoria, $row);
        }
        rewind($memoria);

        //devolvemos el archivo como descarga
        return Response::streamDownload(function () use ($memoria) {
            fpassthru($memoria);
        }, $nombrearchivo);
    }
}
