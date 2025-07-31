<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Empresa\Empleado;
use App\Models\Proyectos\Proyecto;
use App\Models\Proyectos\ProyectoCambio;
use App\Models\Proyectos\ProyectoDoc;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = User::findOrFail(session('id_usuario'));
        return view('intranet.proyectos.proyectos.index', compact('usuario'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuario = User::findOrFail(session('id_usuario'));
        $empleado = $usuario->empleado;
        $lideres1 = Empleado::with('cargo.area.empresa')
            ->where('estado', 1)
            ->where('lider', 1)
            ->whereHas('cargo', function ($p) use ($empleado) {
                $p->whereHas('area', function ($q) use ($empleado) {
                    $q->where('empresa_id', $empleado->cargo->area->empresa_id);
                });
            })->get();

        $lideres2 = Empleado::with('cargo.area.empresa')
            ->where('estado', 1)
            ->where('lider', 1)
            ->whereHas('cargo', function ($p) use ($empleado) {
                $p->whereHas('area', function ($q) use ($empleado) {
                    $q->where('empresa_id', '!=', $empleado->cargo->area->empresa_id);
                });
            })->whereHas('empresas_tranv', function ($p) use ($empleado) {
                $p->where('empresa_id', $empleado->cargo->area->empresa_id);
            })->get();
        $lideres = $lideres1->concat($lideres2);
        return view('intranet.proyectos.proyectos.crear.crear', compact('usuario','lideres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $presupuesto = 0;
        if (isset($request['presupuesto']) && $request['presupuesto'] != null) {
            $presupuesto = $request['presupuesto'];
        }
        $proyecto_new = Proyecto::create([
            'empleado_id' => $request['empleado_id'],
            'empresa_id' => $request['empresa_id'],
            'titulo' => $request['titulo'],
            'fec_creacion' => $request['fec_creacion'],
            'objetivo' => $request['objetivo'],
            'presupuesto' => $presupuesto,
        ]);
        $proyecto_new->miembros_proyecto()->sync([$request['empleado_id'],]);
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('docu_proyecto')) {
            $ruta = Config::get('constantes.folder_doc_proyectos');
            $ruta = trim($ruta);
            $fichero_subido = $ruta . time() . '-' . basename($_FILES['docu_proyecto']['name']);


            $archivo = $request->docu_proyecto;
            $titulo = $archivo->getClientOriginalName();
            $tipo = $archivo->getClientMimeType();
            $url = time() . '-' . basename($_FILES['docu_proyecto']['name']);
            $peso = $archivo->getSize() / 1000;
            move_uploaded_file($_FILES['docu_proyecto']['tmp_name'], $fichero_subido);
            ProyectoDoc::create([
                'proyecto_id' => $proyecto_new->id,
                'titulo' => $titulo,
                'tipo' => $tipo,
                'url' => $url,
                'peso' => $peso,
            ]);
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        ProyectoCambio::create([
            'empleado_id' => $request['empleado_id'],
            'proyecto_id' => $proyecto_new->id,
            'fecha' => $request['fec_creacion'],
            'cambio' => 'Se crea el proyecto',
        ]);
        // - - - - - - - - - - - - - - - - - - - - - - - -
        return redirect('dashboard/proyectos')->with('mensaje', 'Proyecto creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
