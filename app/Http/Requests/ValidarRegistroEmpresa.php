<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarRegistroEmpresa extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'empresa'  => 'required',
            'nit'  => 'required',
            'email_empresa'  => 'required',
            'telefono_empresa'  => 'required',
            'direccion_empresa'  => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'email' => 'required|max:50|unique:users,email,' . $this->route('id'),
            'terminos' => 'required',

        ];
    }

    public function attributes()
    {
        return [
            'empresa' => 'Empresa',
            'nit' => 'NIT',
            'email_empresa' => 'Correo Empresarial',
            'telefono_empresa' => 'Teléfono Empresarial',
            'direccion_empresa' => 'Dirección Empresarial',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'email' => 'Email Usuario',
            'terminos' => 'Terminos y condiciones'
        ];
    }

    public function messages()
    {
        return [
            'empresa.required' => 'El nombre de la empresa es obligatorio',
            'nit.required' => 'El NIT de la empresa es obligatorio',
            'email_empresa.required' => 'El correo de la empresa es obligatorio',
            'telefono_empresa.required' => 'El teléfono de la empresa es obligatorio',
            'direccion_empresa.required' => 'La dirección de la empresa es obligatorio',
            'nombres.required' => 'El nombres del usuario es obligatorio',
            'apellidos.required' => 'El apellidos del usuario es obligatorio',
            'email.required' => 'El campo correo electrónico del usuario es obligatorio',
            'email.unique' => 'El campo correo electrónico del usuario ya se encuentra en la base de datos verifique la información e intentelo nuevamente',
            'terminos.required' => 'Debe aceptar los terminos y condiciones del sistema para poder registrarse',
        ];
    }
}
