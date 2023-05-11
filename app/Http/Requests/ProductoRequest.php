<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'codigo' => ['required','string','unique:productos'],
            'nombre' => ['required','string'],
            'precio' => ['required','string'],
            'cantidad' => ['required','string'],
            'categoria_id' => ['string'],
            'tipo' => ['required','string'],
            //'imagen' => ['image'],
            
        ];
    }
}
