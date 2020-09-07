<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChaveRequest extends FormRequest
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
            'sala' => 'required|string',
            'sel_porteiros' => 'required|string'
        ];
    }

    public function messages()
    {
        return[
            'sala.required' => 'Sala é obrigatória',
            'sel_porteiros.required' => 'Porteiro responsável é obrigatório'
        ];
    }
}
