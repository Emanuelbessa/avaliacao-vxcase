<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequestUpdate extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'purchase_at' => 'required|date|before:tomorrow',
            'delivery_days' => 'required',
            'amount' => 'required',
            'products' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Insira um identificador',
            'purchase_at.required' => 'Por gentileza, selecione uma data válida',
            'delivery_days.required' => 'Erro ao finalizar venda, item sem previsão de entrega',
            'amount.required' => 'Selecione pelo menos 1 item',
            'products.required' => 'Selecione pelo menos 1 item',
        ];
    }
}
