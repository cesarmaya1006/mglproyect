<?php

namespace App\Http\Controllers\Extranet;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidarRegistroEmpresa;
use App\Models\Confi\TipoDocumento;
use App\Models\Empresa\Empresa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExtranetPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('extranet.index.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function registro()
    {
        $tiposdocu = TipoDocumento::get();
        return view('extranet.registro.registro',compact('tiposdocu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function registrar(ValidarRegistroEmpresa $request)
    {
        //dd($request->all());
        $usuarioNew['name'] = ucfirst(strtolower(strtok($request['nombres'], " "))) . ' ' . ucfirst(strtolower(strtok($request['apellidos'], " ")));
        $usuarioNew['email'] = ucfirst(strtolower($request['email']));
        $usuarioNew['password'] = bcrypt(utf8_encode($request['nit']));
        //dd($usuarioNew);
        $usuario_new = User::create($usuarioNew)->syncRoles(['Administrador Empresa']);
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request['tipo_registro']=='Empresa') {
            $empresaNew['tipo_documento_id'] = 6;
            $empresaNew['identificacion'] = $request['nit'];
            $empresaNew['empresa'] = $request['empresa'];
            $empresaNew['email'] = $request['email_empresa'];
            $empresaNew['telefono'] = $request['telefono_empresa'];
            $empresaNew['direccion'] = $request['direccion_empresa'];
            $empresa_new = Empresa::create($empresaNew);
            DB::table('empresa_user')->insert(['user_id' => $usuario_new->id, 'empresa_id' => $empresa_new->id, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),]);
        } else {
            $grupoNew['tipo_documento_id'] = 6;
            $grupoNew['identificacion'] = $request['nit'];
            $grupoNew['empresa'] = $request['empresa'];
            $grupoNew['email'] = $request['email_empresa'];
            $grupoNew['telefono'] = $request['telefono_empresa'];
            $grupoNew['direccion'] = $request['direccion_empresa'];
            $grupo_new = Empresa::create($grupoNew);
            DB::table('grupo_user')->insert(['user_id' => $usuario_new->id, 'grupo_id' => $grupoNew->id, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),]);
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        return redirect('/acceso')->with('mensaje', 'Se realizó el registro de manera exitoza, puede ingresar con su cuenta de correo y el nit de la empresa.');

    }

    /**
     * Display the specified resource.
     */
    public function acceso()
    {
        return view('extranet.login.login');
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
