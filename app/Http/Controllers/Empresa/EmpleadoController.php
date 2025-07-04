<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmpleadoNew;
use App\Models\Confi\TipoDocumento;
use App\Models\Empresa\Cargo;
use App\Models\Empresa\Empleado;
use App\Models\Empresa\Grupo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Laravel\Facades\Image;

class EmpleadoController extends Controller
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
        return view('intranet.empresa.empleados.index', compact('usuario','grupos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuario = User::findOrFail(session('id_usuario'));
        $tiposdocu = TipoDocumento::get();
        if (in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray())) {
            $grupos = Grupo::get();
        } else {
            if ($usuario->grupos_user->count()) {
                $grupos = $usuario->grupos_user;
            } else {
                $grupos = $usuario->empresas_user;
            }
        }
        return view('intranet.empresa.empleados.crear', compact('usuario','grupos','tiposdocu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpleadoNew $request)
    {
        //dd($request->all());
        $usuario = User::findOrFail(session('id_usuario'));
        $usuarioNew['name'] = ucfirst(strtok($request['nombres'], " ")) . ' ' . ucfirst(strtok($request['apellidos'], " "));
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('foto')) {
            $ruta = Config::get('constantes.folder_img_usuarios');
            $ruta = trim($ruta);

            $foto = $request->foto;
            $imagen_foto = Image::read($foto);
            $nombrefoto = time() . $foto->getClientOriginalName();
            $imagen_foto->resize(400, 500);
            $imagen_foto->save($ruta . $nombrefoto, 100);
            $usuarioNew['foto'] = $nombrefoto;
            $empleadoNew['foto'] = $nombrefoto;;
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $usuarioNew['email'] = strtolower($request['email']);
        $usuarioNew['password'] = bcrypt(utf8_encode($request['identificacion']));
        $usuarioNew['licencia'] = $usuario->licencia;
        $usuarioNuevo = User::create($usuarioNew)->syncRoles('Empleado');
        //========================================================================
        $usuarioCrear = User::findOrFail($usuarioNuevo->id);

        $empleadoNew['id'] = $usuarioCrear->id;
        $empleadoNew['cargo_id'] = $request['cargo_id'];
        $empleadoNew['tipo_documento_id'] = $request['tipo_documento_id'];
        $empleadoNew['identificacion'] = $request['identificacion'];
        $empleadoNew['nombres'] = ucwords(strtolower($request['nombres']));
        $empleadoNew['apellidos'] = ucwords(strtolower($request['apellidos']));
        $empleadoNew['telefono'] = $request['telefono'];
        $empleadoNew['direccion'] = $request['direccion'];
        $empleadoNew['vinculacion'] = $request['vinculacion'];
        if (isset($request['lider'])) {
            $empleadoNew['lider'] = 1;
        }
        if (isset($request['mgl'])) {
            $empleadoNew['mgl'] = 1;
        }
        $empleadoNuevo = Empleado::create($empleadoNew);
        //========================================================================
        return redirect('dashboard/configuracion/empleados')->with('mensaje', 'Empleado creado con éxito, puede ingresar al sistema con su email y su identificación como contraseña');

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
        $empleado_edit = Empleado::with('usuario')->findOrFail($id);
         $usuario = User::findOrFail(session('id_usuario'));
        $tiposdocu = TipoDocumento::get();
        if (in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray())) {
            $grupos = Grupo::get();
        } else {
            if ($usuario->grupos_user->count()) {
                $grupos = $usuario->grupos_user;
            } else {
                $grupos = $usuario->empresas_user;
            }
        }
        return view('intranet.empresa.empleados.editar', compact('empleado_edit','usuario','grupos','tiposdocu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmpleadoNew $request, string $id)
    {
        //dd($request->all());
        $empleadoOriginal = Empleado::findOrFail($id);
        $usuarioEditar['name'] = ucfirst(strtok($request['nombres'], " ")) . ' ' . ucfirst(strtok($request['apellidos'], " "));
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('foto')) {
            $ruta = Config::get('constantes.folder_img_usuarios');
            $ruta = trim($ruta);
            $foto = $request->foto;
            $imagen_foto = Image::read($foto);
            $nombrefoto = time() . $foto->getClientOriginalName();
            $imagen_foto->resize(400, 500);
            $imagen_foto->save($ruta . $nombrefoto, 100);
            $usuarioEditar['foto'] = $nombrefoto;
            $empleadoEditar['foto'] = $nombrefoto;
            if ($empleadoOriginal->foto!='usuario-inicial.jpg') {
                unlink($ruta . $empleadoOriginal->foto);
            }
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $usuarioEditar['email'] = strtolower($request['email']);
        $usuarioEditar['password'] = bcrypt(utf8_encode($request['identificacion']));
        $empleadoOriginal->usuario->update($usuarioEditar);
        //========================================================================
        $empleadoEditar['cargo_id'] = $request['cargo_id'];
        $empleadoEditar['tipo_documento_id'] = $request['tipo_documento_id'];
        $empleadoEditar['identificacion'] = $request['identificacion'];
        $empleadoEditar['nombres'] = ucwords(strtolower($request['nombres']));
        $empleadoEditar['apellidos'] = ucwords(strtolower($request['apellidos']));
        $empleadoEditar['telefono'] = $request['telefono'];
        $empleadoEditar['direccion'] = $request['direccion'];
        $empleadoEditar['vinculacion'] = $request['vinculacion'];
        if (isset($request['lider'])) {
            $empleadoEditar['lider'] = 1;
        }else{
            $empleadoEditar['lider'] = 0;
        }
        if (isset($request['mgl'])) {
            $empleadoEditar['mgl'] = 1;
        }else{
            $empleadoEditar['mgl'] = 0;
        }
        if (isset($request['estado'])) {
            $empleadoEditar['estado'] = 1;
        }else{
            $empleadoEditar['estado'] = 0;
        }
        $empleadoOriginal->update($empleadoEditar);
        //========================================================================
        return redirect('dashboard/configuracion/empleados')->with('mensaje', 'Informacion del empleado actualizada con éxito, puede ingresar al sistema con su email y su identificación como contraseña');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getEmpleadosEmpresa(Request $request){
        if ($request->ajax()) {
            $empresa_id = $_GET['id'];
            return response()->json(['empleados' => Empleado::with('usuario')->with('tipo_docu')->with('cargo')->with('cargo.area')->whereHas('cargo', function($q) use($empresa_id){
                $q->whereHas('area', function($p) use($empresa_id){
                    $p->where('empresa_id', $empresa_id);
                });
            })->get()]);
        } else {
            abort(404);
        }
    }
    public function getCargosAreas(Request $request){
        if ($request->ajax()) {
            $area_id = $_GET['id'];
            return response()->json(['cargos' => Cargo::where('area_id',$area_id)->get()]);
        } else {
            abort(404);
        }
    }
}
