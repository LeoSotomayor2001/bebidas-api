<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'tipo' => 'required|string|max:255',
            'imagen' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio',
            'min' => 'El campo :attribute debe tener al menos :min caracteres',
            'max' => 'El campo :attribute debe tener como maximo :max caracteres',
            'string' => 'El campo :attribute debe ser una cadena de caracteres',
            
        ];
    }
}
