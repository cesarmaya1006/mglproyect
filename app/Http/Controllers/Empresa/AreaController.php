<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidacionArea;
use App\Models\Empresa\Area;
use App\Models\Empresa\Grupo;
use App\Models\User;
use Illuminate\Http\Request;

class AreaController extends Controller
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
        return view('intranet.empresa.area.index', compact('usuario','grupos'));
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
        return view('intranet.empresa.area.crear', compact('usuario','grupos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidacionArea $request)
    {
        Area::create($request->all());
        return redirect('dashboard/configuracion/areas')->with('mensaje', 'Área creada con éxito');
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
        $usuario = User::findOrFail(session('id_usuario'));
        $area_edit = Area::findOrFail($id);
        if (in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray())) {
            $grupos = Grupo::get();
        } else {
            if ($usuario->grupos_user->count()) {
                $grupos = $usuario->grupos_user;
            } else {
                $grupos = $usuario->empresas_user;
            }
        }
        return view('intranet.empresa.area.editar', compact('usuario','grupos', 'area_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Area::findOrFail($id)->update($request->all());
        return redirect('dashboard/configuracion/areas')->with('mensaje', 'Área actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $area = Area::findOrFail($id);
            if ($area->cargos->count() > 0) {
                return response()->json(['mensaje' => 'ng']);
            } else {
                if (Area::destroy($id)) {
                    return response()->json(['mensaje' => 'ok']);
                } else {
                    return response()->json(['mensaje' => 'ng']);
                }
            }
        } else {
            abort(404);
        }
    }

    public function getDependencias(Request $request, $id)
    {
        if ($request->ajax()) {
            return response()->json(['dependencias' => Area::where('area_id', $id)->get()]);
        } else {
            abort(404);
        }
    }
    public function getAreas(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(['areasPadre' => Area::with('area_sup')->with('areas')->where('empresa_id', $_GET['id'])->get()]);
        } else {
            abort(404);
        }
    }
}
