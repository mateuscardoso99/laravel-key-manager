<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IniciarAulaRequest extends FormRequest
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
            'data' => 'required|string',
            'sel_porteiros' => 'required|string',
            'sel_alunos' => 'nullable|string',
            'sel_professores' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return[
            'sala.required' => 'Sala é obrigatória',
            'data.required' => 'Insira a data de início',
            'sel_porteiros.required' => 'Porteiro responsável é obrigatório'
        ];
    }
}
