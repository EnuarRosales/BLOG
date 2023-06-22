<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpresaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' =>  ['required'],
            'nit' => ['required'],
            'address' => ['required'],
            'representative' => ['required'],
            'representative_identification_card' => ['required'],
            'number_rooms' => ['required', 'numeric'],
            'capacity_models' => ['required', 'numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'number_rooms.numeric' => 'El campo número de rooms debe ser un número.',
            'capacity_models.numeric' => 'El campo capacidad de modelos debe ser un número.',
        ];
    }
}
