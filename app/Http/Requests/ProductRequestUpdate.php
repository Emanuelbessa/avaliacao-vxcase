<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequestUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'delivery_days' => 'required',
            'name' => 'required',
            'price' => 'required',
            'reference' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Insira um identificador',
            'delivery_days.required' => 'Erro. Determine a previsão de entrega',
            'name.required' => 'Erro. Escolha um nome para o produto',
            'price.required' => 'Erro. Escolha um preço para o produto',
            'reference.required' => 'Erro. Escolha a referência do produto',
        ];
    }
}
