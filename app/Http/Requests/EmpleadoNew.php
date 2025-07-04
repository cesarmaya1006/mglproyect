<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoNew extends FormRequest
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
            'identificacion' => 'required|unique:empleados,identificacion,' . $this->route('id'),
            'email' => 'required|unique:users,email,' . $this->route('id'),

        ];
    }
    public function attributes()
    {
        return [
            'identificacion' => 'Identificación',
            'email' => 'Correo Electrónico',

        ];
    }

    public function messages()
    {
        return [
            'identificacion.required' => 'El campo identificación es obligatorio',
            'identificacion.unique' => 'El campo identificación ya se encuentra en la base de datos verifique la información e intentelo nuevamente',
            'email.required' => 'El campo Email es obligatorio',
            'email.unique' => 'El campo Email ya se encuentra en la base de datos  asociado a otro empleado, verifique la información e intentelo nuevamente',

        ];
    }
}
