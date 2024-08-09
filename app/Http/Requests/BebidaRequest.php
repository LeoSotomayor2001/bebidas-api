<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BebidaRequest extends FormRequest
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
            'nombre' => 'required|string|max:255|min:3',
            "tipo" => "required|string|max:255",
            "imagen" => "required|string|max:255"
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la bebida es obligatorio.',
            'nombre.string' => 'El nombre de la bebida debe ser una cadena de texto.',
            'nombre.max' => 'El nombre de la bebida no puede tener más de :max caracteres.',
            'nombre.min' => 'El nombre de la bebida debe tener minimo 3 caracteres.',
            'tipo.required' => 'El tipo de la bebida es obligatorio.',
            'tipo.string' => 'El tipo de la bebida debe ser una cadena de texto.',
            'tipo.max' => 'El tipo de la bebida no puede tener más de :max caracteres.',
            'imagen.required' => 'La imagen de la bebida es obligatoria.',
            'imagen.string' => 'La imagen de la bebida debe ser una cadena de texto.',
            'imagen.max' => 'La imagen de la bebida no puede tener más de :max caracteres.'
        ];
    }

    //se sobrescribe el método failedValidation de la clase FormRequest para personalizar el manejo de errores
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
