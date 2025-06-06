<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresaRequest;
use App\Models\Confi\TipoDocumento;
use App\Models\Empresa\Empresa;
use App\Models\Empresa\Grupo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Laravel\Facades\Image;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = User::with('roles')->with('grupos_user')->with('empresas_user')->findOrFail(session('id_usuario'));
        if (in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray())) {
            $grupos = Grupo::get();
        } else {
            if ($usuario->grupos_user->count()) {
                $grupos = $usuario->grupos_user;
            } else {
                $grupos = $usuario->empresas_user;
            }
        }

        return view('intranet.empresa.empresas.index', compact('usuario','grupos'));
    }
    public function getEmpresas(Request $request){
        if ($request->ajax()) {
            return response()->json(['empresas' => Empresa::where('grupo_id',$_GET['id'])->get()]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiposdocu = TipoDocumento::get();
        $grupos = Grupo::get();
        $usuario = User::findOrFail(session('id_usuario'));
        return view('intranet.empresa.empresas.crear',compact('tiposdocu','grupos','usuario'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpresaRequest $request)
    {

        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('logo')) {
            $ruta = Config::get('constantes.folder_img_empresas');
            $ruta = trim($ruta);

            $logo = $request->logo;
            $imagen_logo = Image::read($logo);
            $nombrelogo = time() . $logo->getClientOriginalName();
            $imagen_logo->resize(500, 500);
            $imagen_logo->save($ruta . $nombrelogo, 100);
            $empresa_new['logo'] = $nombrelogo;
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $empresa_new['grupo_id'] = $request['emp_grupo_id'];
        $empresa_new['tipo_documento_id'] = $request['tipo_documento_id'];
        $empresa_new['identificacion'] = $request['identificacion'];
        $empresa_new['empresa'] = ucwords(strtolower($request['empresa']));
        $empresa_new['email'] = strtolower($request['email']);
        $empresa_new['telefono'] = $request['telefono'];
        $empresa_new['direccion'] = $request['direccion'];
        $empresa = Empresa::create($empresa_new);
        DB::table('empresa_user')->insert(['user_id' => session('id_usuario'), 'empresa_id' => $empresa->id, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),]);
        return redirect('dashboard/configuracion_sis/empresas')->with('mensaje', 'Empresa creada con éxito');
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
        $tiposdocu = TipoDocumento::get();
        $grupos = Grupo::get();
        $empresa_edit = Empresa::findOrFail($id);
        return view('intranet.empresas.empresas.editar', compact('empresa_edit','tiposdocu','grupos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (isset($request['estado'])) {
            $request['estado'] = 1;
        } else {
            $request['estado'] = 0;
        }
        Empresa::findOrFail($id)->update($request->all());
        return redirect('dashboard/configuracion_sis/empresas')->with('mensaje', 'Empresa actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            if (Empresa::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
