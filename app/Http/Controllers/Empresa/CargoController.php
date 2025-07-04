<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Empresa\Area;
use App\Models\Empresa\Cargo;
use App\Models\Empresa\Grupo;
use App\Models\User;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = User::findOrFail(session('id_usuario'));
        if (in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray())) {
            $grupos = Grupo::get();
        } else {
            if ($usuario->grupos_user->count()) {
                $grupos = $usuario->grupos_user;
            } else {
                $grupos = $usuario->empresas_user;
            }
        }
        return view('intranet.empresa.cargo.index', compact('usuario','grupos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuario = User::findOrFail(session('id_usuario'));
        if (in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray())) {
            $grupos = Grupo::get();
        } else {
            if ($usuario->grupos_user->count()) {
                $grupos = $usuario->grupos_user;
            } else {
                $grupos = $usuario->empresas_user;
            }
        }
        return view('intranet.empresa.cargo.crear', compact('usuario','grupos'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Cargo::create($request->all());
        return redirect('dashboard/configuracion/cargos')->with('mensaje', 'Cargo creado con éxito');
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
        $cargo_edit = Cargo::findOrFail($id);
        $usuario = User::findOrFail(session('id_usuario'));
        if (in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray())) {
            $grupos = Grupo::get();
        } else {
            if ($usuario->grupos_user->count()) {
                $grupos = $usuario->grupos_user;
            } else {
                $grupos = $usuario->empresas_user;
            }
        }

        return view('intranet.empresa.cargo.editar', compact('usuario','grupos','cargo_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Cargo::findOrFail($id)->update($request->all());
        return redirect('dashboard/configuracion/cargos')->with('mensaje', 'Cargo actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $empresa = Cargo::findOrFail($id);
            if ($empresa->empleados->count() > 0) {
                return response()->json(['mensaje' => 'ng']);
            } else {
                if (Cargo::destroy($id)) {
                    return response()->json(['mensaje' => 'ok']);
                } else {
                    return response()->json(['mensaje' => 'ng']);
                }
            }
        } else {
            abort(404);
        }
    }

    public function getAreas(Request $request){
        if ($request->ajax()) {
            return response()->json(['areas' => Area::with('cargos')->with('cargos.area')->where('empresa_id',$_GET['id'])->get()]);
        } else {
            abort(404);
        }
    }
    public function getCargos(Request $request){
        if ($request->ajax()) {
            return response()->json(['cargos' => Cargo::with('area')->where('area_id',$_GET['id'])->get()]);
        } else {
            abort(404);
        }
    }
    public function getCargosTodos(Request $request){
        if ($request->ajax()) {
            $empresa_id = $_GET['id'];
            return response()->json(['cargos' => Cargo::with('area')->whereHas('area', function($q) use($empresa_id){
                $q->where('empresa_id', $empresa_id);
            })->get()]);
        } else {
            abort(404);
        }
    }
    public function getCargosAreas(Request $request){
        if ($request->ajax()) {
            $empresa_id = $_GET['id'];
            return response()->json(['cargos' => Cargo::with('area')->whereHas('area', function($q) use($empresa_id){
                $q->where('empresa_id', $empresa_id);
            })->get()]);
        } else {
            abort(404);
        }
    }
}
