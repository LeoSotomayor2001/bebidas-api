<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BebidaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'nombre' => 'required|string|max:255|min:3',
            'tipo' => 'required|string|max:255',
            'imagen' => 'required|image|max:2048| mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres',
            'tipo.required' => 'El tipo es obligatorio',
            'imagen.required' => 'Debe subir una imagen',
            'imagen.image' => 'El archivo debe ser una imagen',
            'imagen.max' => 'El archivo no debe superar los 2 MB',
            'imagen.mimes' => 'El archivo debe ser una imagen de tipo jpeg,png,jpg,gif,svg',

        ];
    }
    // Sobrescribe el método `failedValidation` que se ejecuta cuando falla la validación.
    protected function failedValidation(Validator $validator)
    {
        $errors = [];

        // Itera sobre los mensajes de error del validador.
        foreach ($validator->errors()->messages() as $field => $message) {
            // Agrega un nuevo error al array `$errors`, con el nombre del campo y el primer mensaje de error.
            $errors[] = [
                'field' => $field,      // Nombre del campo que falló la validación.
                'message' => $message[0] // Primer mensaje de error asociado a ese campo.
            ];
        }

        // Lanza una excepción `HttpResponseException` para devolver una respuesta JSON personalizada.
        throw new HttpResponseException(response()->json([
            'status' => 'fail', // Indica que la operación falló.
            'errors' => $errors, // Incluye todos los errores recopilados en el array `$errors`.
        ], 422)); // El código de estado HTTP 422 indica que la entidad no pudo ser procesada (errores de validación).
    }
}
